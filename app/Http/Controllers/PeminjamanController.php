<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.peminjaman.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $buku = buku::orderBy('id_inven', 'asc')->get();
        $anggota = anggota::orderBy('id', 'asc')->get();
        $buku = buku::with('inventaris')->orderBy('id_inven', 'asc')->get();
        // dd($buku->first()->inventaris);
        // dd($buku['status']);
        return view('admin.peminjaman.create', compact('buku', 'anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'lama_peminjaman' => 'required',
            'id_buku' => 'required'
        ]);

        $jumlah_buku = count($request['id_buku']);

        $peminjaman = $request->all();
        unset($peminjaman['id_buku']);

        dd($peminjaman);
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
