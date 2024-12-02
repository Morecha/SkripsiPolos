<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\peminjaman;
use App\Models\pivot;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = peminjaman::withCount('pivot')
                    ->where('status', 'dipinjam')
                    ->get();

        foreach($peminjaman as $p){
            if ($p->id_anggota == null){
                $p['jenis_peminjaman'] = 'kelompok';
                $p['id_user'] = User::find($p->id_user)->name;
            }elseif ($p->id_user == null){
                $p['jenis_peminjaman'] = 'individu';
                $p['id_anggota'] = anggota::find($p->id_anggota)->name;
            }
        }
        // dd($peminjaman);
        return view('admin.peminjaman.list',compact('peminjaman'));
    }

    public function detail(string $id){
        // dd($id, $jenis);
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->find($id);

        // dd($peminjaman);
        if ($peminjaman->id_anggota == null){
            $peminjaman['jenis_peminjaman'] = 'kelompok';
        }elseif ($peminjaman->id_user == null){
            $peminjaman['jenis_peminjaman'] = 'individu';
        }

        return view('admin.peminjaman.detail', compact('peminjaman'));
    }

    public function detail_pengembalian(string $id){
        // dd($id, $jenis);
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->find($id);

        // dd($peminjaman);
        if ($peminjaman->id_anggota == null){
            $peminjaman['jenis_peminjaman'] = 'kelompok';
        }elseif ($peminjaman->id_user == null){
            $peminjaman['jenis_peminjaman'] = 'individu';
        }

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
        // dd($buku);
        // dd($buku['status']);
        return view('admin.peminjaman.create', compact('buku', 'anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =[
            'jenis_peminjaman' => 'required',
            'lama_peminjaman' => 'required',
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

        // dd($request['id_buku'],$jumlah_buku,$request,$peminjaman);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dipinjam = peminjaman::with(['pivot.buku.inventaris','anggota','user'])
                    ->withCount('pivot')
                    ->find($id);

        $buku = buku::with('inventaris')
                ->where('posisi', 'ada')
                ->orderBy('id_inven', 'asc')->get();
        // dd($buku->inventaris);
        if($dipinjam->id_anggota == null){
            $dipinjam['jenis_peminjaman'] = 'kelompok';
            return view('admin.peminjaman.edit', compact('dipinjam','buku'));
        }elseif ($dipinjam->id_user == null){
            $dipinjam['jenis_peminjaman'] = 'individu';
            $list_anggota = anggota::where('id','!=',$dipinjam->id_anggota)
                        ->orderBy('id', 'asc')->get();
            // dd($list_anggota);
            return view('admin.peminjaman.edit', compact('dipinjam','buku','list_anggota'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lama_peminjaman' => 'required',
            'id_buku' => 'required',
            'deskripsi' => 'nullable',
        ]);
        $input = $request->all();
        $peminjaman = peminjaman::with('pivot')->find($id);
        $buku = buku::find($request['id_buku']);

        if($request['id_anggota'] == null){
            unset($input['id_anggota']);
        }elseif($request['id_user'] == null){
            unset($input['id_user']);
        }

        // 1. bandingin yang lama sama yang baru
        //    klo yang lama ga ada di yang baru di drop
        // 2. bedakan jadi 3 buah
        //    - klo ada di lama tapi ga ada di yang baru (hapus)
        //    - klo ada di lama tapi ada jg di yang baru (update)
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

        foreach($input['id_buku'] as $r){
            $added = [];
            if(!in_array($r, $id_buku_peminjaman_lama_biasa)){
                pivot::create([
                    'id_peminjaman' => $id,
                    'id_buku' => $r
                ]);
                $update = buku::find($r);
                $update->posisi = 'dipinjam';
                $update->save();
            }
        }
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
        foreach($peminjaman as $p){
            if ($p->id_anggota == null){
                $p['jenis_peminjaman'] = 'kelompok';
                $p['id_user'] = User::find($p->id_user)->name;
            }elseif ($p->id_user == null){
                $p['jenis_peminjaman'] = 'individu';
                $p['id_anggota'] = anggota::find($p->id_anggota)->name;
            }
        }
        // dd($peminjaman);
        return view('admin.pengembalian.list',compact('peminjaman'));
    }

    public function pengembalian_create(string $id){
        $dipinjam = peminjaman::with(['pivot.buku.inventaris','anggota','user'])
                    ->withCount('pivot')
                    ->find($id);

        $buku = buku::with('inventaris')
                ->where('posisi', 'ada')
                ->orderBy('id_inven', 'asc')->get();
        // dd($buku->inventaris);
        if($dipinjam->id_anggota == null){
            $dipinjam['jenis_peminjaman'] = 'kelompok';
            return view('admin.pengembalian.create', compact('dipinjam','buku'));
        }elseif ($dipinjam->id_user == null){
            $dipinjam['jenis_peminjaman'] = 'individu';
            $list_anggota = anggota::where('id','!=',$dipinjam->id_anggota)
                        ->orderBy('id', 'asc')->get();
            // dd($list_anggota);
            return view('admin.pengembalian.create', compact('dipinjam','buku','list_anggota'));
        }
    }

    public function pengembalian_store(Request $request, string $id){
        // dd($request,$id);
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])
                    ->find($id);
        $peminjaman->status = 'kembali';
        $peminjaman->detail = $request->detail;
        foreach($peminjaman->pivot as $p){
            $buku = buku::find($p->id_buku);
            $buku->posisi = 'ada';
            $buku->save();
        }
        $peminjaman->save();
        return redirect()->route('peminjaman.list')->with('success', 'Data peminjaman berhasil dikembalikan');
    }

    public function pengembalian_edit(string $id){
        $pengembalian = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->find($id);
        if ($pengembalian->id_anggota == null){
            $pengembalian['jenis_peminjaman'] = 'kelompok';
        }elseif ($pengembalian->id_user == null){
            $pengembalian['jenis_peminjaman'] = 'individu';
        }
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
