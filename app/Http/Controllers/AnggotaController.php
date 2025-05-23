<?php

namespace App\Http\Controllers;

use App\Imports\AnggotaImport;
use App\Models\anggota;
use App\Models\peminjaman;
use Dotenv\Exception\ValidationException;
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
            'name' => 'required|string|max:255',
            'angkatan' => 'required|integer|max:10000',
            'NIS' => 'required|string|min:4',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();

        $anggota = anggota::where('NIS', $input['NIS'])->first();
        if($anggota != null){
            return redirect()->route('anggota.list')->with('error', 'NIS sudah ada');
        }

        anggota::create($input);

        return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function edit(string $id){
        $anggota = anggota::find($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, string $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'angkatan' => 'required|integer|max:10000',
            'NIS' => 'required|string|min:4',
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
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function aktivasi_anggota(string $id){
        $anggota = anggota::find($id);
        if($anggota == null){
            return redirect()->route('anggota.list')->with('error', 'Data anggota tidak ditemukan');
        }
        $anggota->toggleStatus();
        return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil diupdate');
    }

    public function destroy(string $id){
        $anggota = anggota::find($id);
        $peminjaman = peminjaman::where('id_anggota', $id)->get()->count();
        if($peminjaman > 0){
            return redirect()->route('anggota.list')->with('error', 'Anggota masih memiliki PEMINJAMAN');
        }

        $anggota->delete();
        return redirect()->route('anggota.list')->with('success', 'Data anggota berhasil dihapus');
    }
}
