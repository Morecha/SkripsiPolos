<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\peminjaman;
use App\Models\pivot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use function PHPSTORM_META\type;

class PeminjamanController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('superadmin-or-admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->where('status', 'dipinjam')
                    ->get();

        return view('admin.peminjaman.list',compact('peminjaman'));
    }

    public function detail(string $id){
        // dd($id, $jenis);
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->find($id);

        return view('admin.peminjaman.detail', compact('peminjaman'));
    }

    public function detail_pengembalian(string $id){
        // dd($id, $jenis);
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->find($id);

        return view('admin.pengembalian.detail', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $buku = buku::orderBy('id_inven', 'asc')->get();
        $anggota = anggota::orderBy('id', 'asc')->get();
        $buku = buku::with('inventaris')
                ->where('posisi', 'ada')
                ->orderBy('id_inven', 'asc')->get();

        return view('admin.peminjaman.create', compact('buku', 'anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =[
            'jenis_peminjaman' => 'required',
            'lama_peminjaman' => 'required|integer|max:10000',
            'id_buku' => 'required',
            'deskripsi' => 'nullable',
        ];
        if($request['jenis_peminjaman'] == 'kelompok'){
            $rules['id_user'] = 'required';
            unset($request['id_anggota']);
        }
        elseif($request['jenis_peminjaman'] == 'individu'){
            $rules['id_anggota'] = 'required';
            unset($request['id_user']);
        }
        $request->validate($rules);

        $peminjaman = $request->all();
        unset($peminjaman['id_buku']);

        //create peminjaman baru
        $peminjaman['status'] = 'dipinjam';
        $borrow = peminjaman::create($peminjaman);

        $cek_buku = [];
        $data_buku = [];

        foreach($request['id_buku'] as $id_buku){
            if(!in_array($id_buku, $cek_buku)){
                $cek_buku[] = $id_buku;
                // $data_buku[] = buku::find($id_buku);
                // $peminjaman;

                //tabel buku
                $buku = buku::find($id_buku);
                if($request['jenis_peminjaman'] == 'individu'){
                    $buku->posisi = 'dipinjam';
                }elseif($request['jenis_peminjaman'] == 'kelompok'){
                    $buku->posisi = 'kelas';
                }
                $buku->save();

                pivot::create([
                    'id_peminjaman' => $borrow->id,
                    'id_buku' => $id_buku,
                ]);
            }
        }
        return redirect('/peminjaman')->with('success', 'Peminjaman Berhasil');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dipinjam = peminjaman::with(['pivot.buku.inventaris','anggota','user'])
                    ->withCount('pivot')
                    ->find($id);

        $get_id_buku = [];
        foreach($dipinjam->pivot as $p){
            $get_id_buku[] = $p->id_buku;
        }
        $buku = buku::with('inventaris')
                ->where('posisi', 'ada')
                ->whereNotIn('id', $get_id_buku)
                ->orderBy('id_inven', 'asc')->get();

        if($dipinjam->id_anggota == null){
            return view('admin.peminjaman.edit', compact('dipinjam','buku'));
        }elseif ($dipinjam->id_user == null){
            $list_anggota = anggota::where('id','!=',$dipinjam->id_anggota)
                        ->orderBy('id', 'asc')->get();
            return view('admin.peminjaman.edit', compact('dipinjam','buku','list_anggota'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lama_peminjaman' => 'required|integer|max:10000',
            'id_buku' => 'nullable',
            'deskripsi' => 'nullable',
        ]);
        $input = $request->all();
        $peminjaman = peminjaman::with('pivot')->find($id);
        $buku = collect(buku::find($request['id_buku']));

        //menambahkan yang disabled kedalam inputan yg ada
        foreach($peminjaman->pivot as $p){
            $add_buku = buku::find($p->id_buku);
            if($add_buku->posisi == 'hilang'||$add_buku->posisi == 'ada' || $add_buku->posisi == 'dimusnahkan'){
                $buku->push($add_buku);
                $input['id_buku'][] = "$add_buku->id";
            }
        }
        // dd($buku,$request,$input);
        if($request['id_anggota'] == null){
            unset($input['id_anggota']);
        }elseif($request['id_user'] == null){
            unset($input['id_user']);
        }

        // 1. bandingin yang lama sama yang baru
        //    klo yang lama ga ada di yang baru di drop
        // 2. bedakan jadi 3 buah
        //    - klo ada di lama tapi ga ada di yang baru (hapus)
        //    - klo ada di lama tapi ada jg di yang baru (biarkan)
        //    - klo ga ada di lama tapi ada di yang baru (tambah)

        $id_buku_peminjaman_lama_asosiatif = []; //array asosiatif
        $id_buku_peminjaman_lama_biasa = []; //array biasa
        $deleted = [];
        foreach($peminjaman->pivot as $p){
            $id_buku_peminjaman_lama_asosiatif[] = [
                'id' => $p->id,
                'id_buku' => (string)$p->id_buku
            ];
            $id_buku_peminjaman_lama_biasa[] = (string)$p->id_buku;
        }

        // cek apa ada buku lama yang tidak ada di buku baru
        // klo ga ada delete + perbarui posisi buku
        foreach($id_buku_peminjaman_lama_asosiatif as $q){
            if(!in_array($q['id_buku'], $input['id_buku'])){
                $for_delete = pivot::find($q['id']);
                $update = buku::find($q['id_buku']);
                $update->posisi = 'ada';
                $update->save();
                $for_delete->delete();
            }
        }

        //buku baru klo ga ada di lama di tambahkan
        foreach($input['id_buku'] as $r){
            $added = [];
            if(!in_array($r, $id_buku_peminjaman_lama_biasa)){
                pivot::create([
                    'id_peminjaman' => $id,
                    'id_buku' => $r
                ]);
                $update = buku::find($r);
                if($peminjaman->jenis_peminjaman == 'kelompok'){
                    $update->posisi = 'kelas';
                }elseif($peminjaman->jenis_peminjaman == 'individu'){
                    $update->posisi = 'dipinjam';
                }
                $update->save();
            }
        }

        if($peminjaman->id_user != null){
            $input['id_user'] = $peminjaman->id_user;
        }

        $peminjaman->update($input);
        // dd('cek',$id_buku_peminjaman_id_buku,$deleted,$input['id_buku'],$added);
        return redirect('/peminjaman')->with('success', 'Pembaruan Peminjaman Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = peminjaman::find($id);
        $pivot = pivot::where('id_peminjaman', $id)->get();
        //edit status buku
        foreach($pivot as $p){
            $buku = buku::find($p->id_buku);
            if($buku){
                $buku->posisi = 'ada';
                $buku->save();
            }
            $p->delete();
        }
        $peminjaman->delete();
        return redirect()->route('peminjaman.list')->with('success', 'Data peminjaman berhasil dihapus');
    }

//======================================================================================================================
//======================================================================================================================

    public function pengembalian(){
        $peminjaman = peminjaman::with(['pivot.buku.inventaris','anggota','user'])
                    ->withCount('pivot')
                    ->where('status', 'kembali')
                    ->get();
        // dd($peminjaman);
        return view('admin.pengembalian.list',compact('peminjaman'));
    }

    public function pengembalian_create(string $id){
        $dipinjam = peminjaman::with(['pivot.buku.inventaris','anggota','user'])
                    ->withCount('pivot')
                    ->find($id);

        return view('admin.pengembalian.create', compact('dipinjam'));
    }

    public function pengembalian_store(Request $request, string $id){
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])->find($id);
        $data_status_baru = $request->all();
        unset($data_status_baru['_token']);
        unset($data_status_baru['detail']);
        $data_status_baru = array_values($data_status_baru);
        $cek_status = [];

        foreach($peminjaman->pivot as $index => $p){
            $buku = buku::find($p->id_buku);
            $pivot = pivot::find($p->id);

            if($data_status_baru[$index] == 'kembali'){
                $data_posisi_buku = 'ada';
            }elseif($data_status_baru[$index] == 'dipinjam'){
                if($peminjaman->jenis_peminjaman == 'individu'){
                    $data_posisi_buku = 'dipinjam';
                }elseif($peminjaman->jenis_peminjaman == 'kelompok'){
                    $data_posisi_buku = 'kelas';
                }
            }elseif($data_status_baru[$index] == 'hilang'){
                $data_posisi_buku = 'hilang';
            }
            $buku->posisi = $data_posisi_buku;
            $pivot->status = $data_status_baru[$index];

            $cek_status[$index] = $buku->posisi;

            $buku->save();
            $pivot->save();
        }
        // dd($data_status_baru,$data_status_lama,$id,$peminjaman,$cek_status);
        if(in_array('dipinjam', $cek_status)||in_array('kelas', $cek_status)){
            $peminjaman->status = 'dipinjam';
        } else {
            $peminjaman->status = 'kembali';
        }

        $peminjaman->detail = $request->detail;
        $peminjaman->save();
        return redirect()->route('peminjaman.list')->with('success', 'Data peminjaman berhasil dikembalikan');
    }

    public function pengembalian_edit(string $id){
        $pengembalian = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->find($id);

        return view('admin.pengembalian.edit',compact('pengembalian'));
    }

    public function pengembalian_update(Request $request, string $id){
        $pengembalian = peminjaman::find($id);
        $pengembalian->detail = $request->detail;
        $pengembalian->save();
        return redirect()->route('pengembalian.list')->with('success', 'Data pengembalian berhasil diubah');
    }

    public function pengembalian_destroy(string $id){
        $pengembalian = peminjaman::find($id);
        $pengembalian->delete();
        return redirect()->route('pengembalian.list')->with('success', 'Data pengembalian berhasil dihapus');
    }
}
