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
        $peminjaman = peminjaman::with(['pivot.buku.inventaris'])
                    ->withCount('pivot')
                    ->find($id);

        if ($peminjaman->id_anggota == null){
            $peminjaman['jenis_peminjaman'] = 'kelompok';
        }elseif ($peminjaman->id_user == null){
            $peminjaman['jenis_peminjaman'] = 'individu';
        }

        // dd($peminjaman);
        return view('admin.peminjaman.detail', compact('peminjaman'));
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
                $data_buku[] = buku::find($id_buku);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
