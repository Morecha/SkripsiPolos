<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\inventaris;
use App\Models\pengadaan;
// use Faker\Core\File;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        $path = public_path('/dewey/test.json');
        if(!File::exists($path)){
            dd('File Tidak Ditemukan');
            return view('admin.inventaris.list');
        }

        $json =  File::get($path);
        $data = json_decode($json, true);
        // dd($dewey);
        return view('admin.inventaris.create', compact('data'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if($request->file('image')){
            $destinationPath = 'gambar/inventaris';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
            $input['image'] = "$profileImage";
        }

        // dd($input);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $update = inventaris::find($id);
        $pengadaan = pengadaan::where('id_inventaris', $update->id)->first();

        $input = $request->all();
        if($pengadaan != null){
            $pengadaan['diterima'] = $input['eksemplar'];
            $pengadaan->update();
        }

        if($request->file('image')){
            $destinationPath = 'gambar/inventaris';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            if($update->image != null){
                $oldImage = $update->image;
                if(file_exists(public_path('storage/gambar/inventaris/'.$oldImage))){
                    unlink(public_path('storage/gambar/inventaris/'.$oldImage));
                }
            }
            $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
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

        if($data->image != null){
            if(file_exists(public_path('storage/gambar/inventaris/'.$data->image))){
                unlink(public_path('storage/gambar/inventaris/'.$data->image));
            }
        }
        $data->delete();
        return redirect()->route('inventaris.list')->with('success', 'Data inventaris berhasil dihapus');
    }

    public function cetak(){

    }
}



