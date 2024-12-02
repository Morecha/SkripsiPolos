<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use App\Models\pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = pengadaan::all();
        // dd($data);
        return view('admin.pengadaan.list', compact('data'));

        // $invenData = DB::table('inventaris')
        //         ->select('id_pengadaan',DB::raw('sum(eksemplar) as total_buku'))
        //         ->groupBy('id_pengadaan')
        //         ->get();

        // // Memasukkan data inventaris ke dalam data pengadaan berdasarkan id_pengadaan
        // foreach ($data as $item) {
        //     $item->total_buku = 0; // Menginisialisasi total_buku ke 0 jika tidak ada inventaris terkait
        //     foreach ($invenData as $invenItem) {
        //         if ($invenItem->id_pengadaan == $item->id) {
        //             $item->total_buku = $invenItem->total_buku;
        //             break;
        //         }
        //     }
        // }
        // // dd($data);
        // return view('admin.pengadaan.list', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengadaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang'=> 'nullable',
            'penerbit' => 'nullable',
            'kode_ddc' => 'nullable',
            'status' => 'required',
            'eksemplar' => 'required',
            'deskripsi' => 'nullable',
        ]);
        $request['diterima'] = 0;
        $input = $request->all();
        pengadaan::create($input);
        return redirect()->route('pengadaan.list')->with('success', 'Pengadaan Berhasil');
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
        $data = pengadaan::find($id);
        // dd($data);
        return view('admin.pengadaan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang'=> 'nullable',
            'penerbit' => 'nullable',
            'kode_ddc' => 'nullable',
            'status' => 'required',
            'eksemplar' => 'required',
            'deskripsi' => 'nullable',
        ]);
        $input = $request->all();
        $data = pengadaan::find($id);
        // dd($request,$data);
        if($data->id_inventaris != null){
            $inventaris = inventaris::find($data->id_inventaris);
            if($inventaris->eksemplar > $request->eksemplar){
                return redirect()->back()->with('error', 'Jumlah eksemplar melebihi inventaris');
            }
        }
        $data->update($input);
        return redirect()->route('pengadaan.list')->with('success', 'Edit Pengadaan Berhasil');
    }

    public function inventaris(string $id){
        $data = pengadaan::find($id);
        // dd($data['pengarang'],$data['penerbit'],$data);
        if($data['pengarang'] == null || $data['penerbit'] == null){
            return redirect()->back()->with('error', 'Tidak ditemukan Data pengarang dan penerbit, Harap Edit data Terlebih dahulu');
        }
        if($data->eksemplar - $data->diterima > 0){
            $inventaris = $data->inventaris;
            // dd($inventaris);
            return view('admin.pengadaan.inventaris', compact('data', 'inventaris'));
        }
        return redirect()->back();
    }

    public function inventaris_store(Request $request, string $id){

        $data = pengadaan::find($id);
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:'.$data->eksemplar-$data->diterima,
            'deskripsi' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $data->toArray();
        $update = $data->toArray();
        // dd($request->jumlah);
        // mencari inventaris pengadaan
        $refrence = inventaris::find($data->id_inventaris);
        // dd($input, $update);
        if($refrence==null){
            $input['eksemplar'] = $request->jumlah;
            unset($input['id']);
            unset($input['id_inventaris']);
            unset($input['diterima']);
            // create input inventaris
            // dd($input['eksemplar']);

            if($request->file('image')){
                $destinationPath = 'gambar/inventaris';
                $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
                $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
                $input['image'] = "$profileImage";
            }

            $id_inven = inventaris::create($input);

            $update['id_inventaris'] = $id_inven->id;
            $update['diterima'] = $id_inven->eksemplar;
            $coba = $data->update($update);
        }else{
            // klo udah ada inventarisnya terkait
            unset($input['id']);//ga butuh id makanya di unset
            $input['eksemplar'] = $refrence->eksemplar + $request->jumlah;
            $update['diterima'] = $refrence->eksemplar + $request->jumlah;
            // $inven = $refrence->update($input);//inventaris
            // $coba = $data->update($update);//pengadaan

            if($refrence['image'] == null && $request->file('image') != null){
                $destinationPath = 'gambar/inventaris';
                $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
                $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
                $refrence->update(['image' => "$profileImage"]);
            }

            $refrence->update(['eksemplar'=> $input['eksemplar']]);
            $data->update(['diterima'=> $update['diterima']],
                        ['deskripsi'=> $request->deskripsi]);
        }
        return redirect()->route('pengadaan.list')->with('success', 'Pengadaan to inventaris Berhasil');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = pengadaan::find($id);
        if($data->id_inventaris != null){
            return redirect()->back()->with('error', 'Pengadaan ini mempunyai inventaris');
        }
        $data->delete();
        return redirect()->route('pengadaan.list')->with('success', 'Penghapusan Pengadaan Berhasil');
    }
}
