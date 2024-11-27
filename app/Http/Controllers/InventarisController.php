<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\inventaris;
use App\Models\pengadaan;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super-admin');
    }

    public function index(){
        $data = inventaris::all();
        $bukus_count = Buku::select('id_inven', DB::raw('COUNT(*) as buku_count'))
            ->groupBy('id_inven')
            ->get();
        foreach ($data as $inventaris) {
            $bukuCount = $bukus_count->firstWhere('id_inven', $inventaris->id);
            $inventaris->buku_count = $bukuCount ? $bukuCount->buku_count : 0;
        }
        return view('admin.inventaris.list',compact('data'));
    }

    public function create(){
        return view('admin.inventaris.create');
    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kode_ddc' => 'required',
            'status' => 'required',
            'deskripsi' => 'nullable',
            'eksemplar' => 'required',
        ]);
        $input = $request->all();
        inventaris::create($input);
        return redirect()->route('inventaris.list')->with('success', 'Data inventaris berhasil ditambahkan');
    }

    public function edit(string $id){
        $data = inventaris::find($id);
        $pengadaan = pengadaan::where('id_inventaris', $data->id)->first();
        $jumlah_buku = buku::where('id_inven', $id)->get()->count();
        // dd($data, $pengadaan);
        return view('admin.inventaris.edit',compact('data','pengadaan','jumlah_buku'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kode_ddc' => 'required',
            'status' => 'required',
            'deskripsi' => 'nullable',
            'eksemplar' => 'required',
        ]);

        $update = inventaris::find($id);
        $pengadaan = pengadaan::where('id_inventaris', $update->id)->first();

        $input = $request->all();
        if($pengadaan != null){
            $pengadaan['diterima'] = $input['eksemplar'];
            $pengadaan->update();
        }
        $update->update($input);
        return redirect()->route('inventaris.list')->with('success', 'Data inventaris berhasil diupdate');
    }

    public function destroy($id){
        $data = inventaris::find($id);
        $pengadaan = pengadaan::where('id_inventaris', $data->id)->first();
        $jumlah_buku = buku::where('id_inven', $id)->get()->count();
        // dd($pengadaan['diterima'],$data->eksemplar);
        if($jumlah_buku > 0){
            return redirect()->back()->with('error', 'Data inventaris masih terdapat buku');
        }
        if($pengadaan != null){
            $pengadaan['diterima'] = $pengadaan['diterima'] - $data->eksemplar;
            $pengadaan->update();
        }
        $data->delete();
        return redirect()->route('inventaris.list')->with('success', 'Data inventaris berhasil dihapus');
    }

    public function cetak(){

    }
}



