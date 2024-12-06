<?php

namespace App\Http\Controllers;

use App\Imports\AnggotaImport;
use App\Models\anggota;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin-or-admin');
    }

    public function index(){
        $anggota = anggota::all();
        // dd($anggota);
        return view('admin.anggota.list', compact('anggota'));
    }

    public function create(){
        return view('admin.anggota.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'angkatan' => 'required',
            'NIS' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        anggota::create($input);

        return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function edit(string $id){
        $anggota = anggota::find($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, string $id){
        $request->validate([
            'name' => 'required',
            'angkatan' => 'required',
            'NIS' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $update = anggota::find($id);
        // dd($input);
        $update->update($input);
        return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil diupdate');
    }

    public function create_masal(){
        return view('admin.anggota.mass');
    }

    public function store_masal(Request $request){
        $request->validate([
            'data' => 'required|file|mimes:xls,xlsx',
        ]);

        try{
            $test = Excel::import(new AnggotaImport, $request->file('data'));
            return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil ditambahkan');
            dd('berhasil');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'format excel salah');
        }
    }

    public function aktivasi_anggota(string $id){
        $anggota = anggota::find($id);
        if($anggota['status'] == 'aktif'){
            $anggota->status = 'non-aktif';
            $anggota->save();
        }
        elseif($anggota['status'] == 'non-aktif')
        {
            $anggota->status = 'aktif';
            $anggota->save();
        }
        return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil diupdate');
    }

    public function destroy(string $id){
        $anggota = anggota::find($id);
        $peminjaman = peminjaman::where('id_anggota', $id)->get()->count();
        if($peminjaman > 0){
            return redirect()->route('anggota.list')->with('error', 'Anggota masih memiliki PEMINJAMAN');
        }
        // dd($peminjaman);
        $anggota->delete();
        return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil dihapus');
    }
}
