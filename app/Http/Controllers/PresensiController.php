<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin-or-admin');
    }

    public function index()
    {
        $data = presensi::all();
        $testing = DB::table('presensis')
            ->leftJoin('anggotas', 'presensis.id_anggota', '=', 'anggotas.id')
            ->leftJoin('users', 'presensis.id_user', '=', 'users.id')
            ->select('presensis.id as id_presensi', 'presensis.*', 'anggotas.*', 'users.*')
            ->get();
        // dd($testing);
        return view('admin.presensi-kelompok.list',compact('testing'));
    }

    public function create_kelompok()
    {
        $user = User::whereIn('role', ['Admin', 'PenanggungJawab'])->get();
        return view('admin.presensi-kelompok.create', compact('user'));
    }

    public function store_kelompok(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'nullable',
        ]);

        $input = $request->all();
        $input['status_presensi'] = 'kelompok';
        $input['id_anggota'] = null;

        $data = presensi::create($input);
        return redirect()->route('presensi.list')->with('success', 'Data presensi kelompok berhasil ditambahkan');
    }

    public function create_individu(){}
    public function store_individu(){}

    public function edit($id){
        $data = presensi::find($id);
        // dd($data,$data['status_presensi']);
        if($data['status_presensi'] == 'kelompok')
        {
            $user = User::whereIn('role', ['Admin', 'PenanggungJawab'])->get();
        }else{
            $user = anggota::all();
        }
        return view('admin.presensi-kelompok.edit',compact('data','user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'id_user' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'nullable',
        ]);

        $input = $request->all();
        $data = presensi::find($id);
        $data->update($input);

        return redirect()->route('presensi.list')->with('success', 'Data presensi kelompok berhasil diupdate');
    }

    public function destroy($id){
        $deleted = presensi::find($id)->delete();
        return redirect()->route('presensi.list')->with('success', 'Data presensi kelompok berhasil dihapus');
    }
}
