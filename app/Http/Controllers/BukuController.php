<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\inventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function generate_buku($id){
        $inventaris = inventaris::find($id);
        $buku = buku::where('id_inven', $id)->get();
        // 370(klasifikasi), sum(tajuk_buku, 3 huruf pertama nama pengarang), p(1 huruf judul),
        $kode_ddc = $inventaris['kode_ddc'];
        $tajuk_buku = substr($inventaris['pengarang'], 0, 3);
        $judul = substr($inventaris['judul'], 0, 1);
        // $kode_buku = $kode_ddc."-".$tajuk_buku."-".$judul."-"."1";

        $input = [];
        //klo buku kosong pada inven
        if($buku->count() == 0){
            $banyak = $inventaris['eksemplar'];
            for($i=1; $i<=$banyak; $i++){
                $input[] = [
                    'id_inven' => $id,
                    'kode_buku' => $kode_ddc."-".$tajuk_buku."-".$judul."-".$i,
                    'posisi' => 'ada',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        //klo buku ada di inven
        }else{
            $string = $buku->last()->kode_buku;
            $pisah = explode('-', $string);
            $akhir = intval($pisah[3])+1;
            // dd($kode_ddc!=$pisah[0], $tajuk_buku!=$pisah[1], $judul!=$pisah[2]);

            if($kode_ddc!=$pisah[0] || $tajuk_buku!=$pisah[1] || $judul!=$pisah[2])
            {
                //kondisi klo disana regenerate tetapi kode invennya beda
                //harus cek posisi buku (agar tidak crash dengan buku yang dipinjam)
                $diluar = $buku->filter(function ($item) {
                    return $item->posisi != 'ada';
                })->count();

                // 1. rubah dulu data yang ada.
                if($diluar == 0){
                    foreach ($buku as $item){
                        $explode = explode('-', $item->kode_buku);
                        $kode_buku_baru = $kode_ddc."-".$tajuk_buku."-".$judul."-".$explode[3];
                        $update = buku::find($item->id);
                        $update->update([
                            'kode_buku' => $kode_buku_baru
                        ]);
                    }
                }
                else{
                    return back()->with('error', 'Terdapat buku yang dipinjam');
                }
            }

            //Tambahkan buku baru
            $banyak = $inventaris['eksemplar'] - $buku->count();
            for($i=$akhir; $i<=$inventaris['eksemplar']+$banyak; $i++){
                $input[] = [
                    'id_inven' => $id,
                    'kode_buku' => $kode_ddc."-".$tajuk_buku."-".$judul."-".$i,
                    'posisi' => 'ada',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        buku::insert($input);
        return redirect()->route('inventaris.list')->with('success', 'Data inventaris berhasil ditambahkan');
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $inventaris = inventaris::find($id);
        $data = buku::where('id_inven', $id)->get();
        $banyak = $data->count();
        // dd($inventaris,$data);
        return view('admin.inventaris.buku.list', compact('data', 'inventaris', 'banyak'));
    }

    public function list_cetak($id)
    {
        $buku = buku::where('id_inven', $id)->get();
        // dd($buku);
        $data = [];
        // dd($buku);
        foreach ($buku as $key => $value) {
            $pisah = explode('-', $value['kode_buku']);
            $data[] = [
                'kode_buku' => $pisah[0].'-'.$pisah[1].'-'.$pisah[2].'-'.$pisah[3],
            ];
        }
        // dd($id);
        return view('admin.inventaris.list-cetak', compact('data','id'));
    }

    public function cetak(Request $request, $id)
    {
        $inventaris = inventaris::find($id);
        // dd($request,$inventaris);
        $kode = $request->all();
        unset($kode['_token']);
        $data = [];
        foreach($request->all() as $key => $value){
            if(strpos($key, 'print')===0){
                $pisah = explode('-', $value);
                $data[] = [
                    'kodeddc' => $pisah[0],
                    'pengarang' => $pisah[1],
                    'judul' => $pisah[2],
                    'copy' => $pisah[3],
                ];
            }
        }
        // dd($data, $kode);
        $pdf = Pdf::loadView('admin.laporan.cetakBuku', compact('data','kode'));
        return $pdf->stream($inventaris['judul'].'.pdf');
        // return view('admin.laporan.cetakBuku', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id, string $id_buku)
    {
        $data = buku::find($id_buku);
        $inventaris = inventaris::find($id);
        // dd($data, $inventaris);
        return view('admin.inventaris.buku.edit', compact('data', 'inventaris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $id_buku)
    {
        $request->validate([
            'posisi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $inventaris = inventaris::find($id);
        $buku = buku::find($id_buku);
        $input = $request->all();

        // dd($input->image);
        if($request->file('image')){
            $destinationPath = 'gambar/buku';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            if($buku->image != null){
                $oldImage = $buku->image;
                if(file_exists(public_path('storage/gambar/buku/'.$oldImage))){
                    unlink(public_path('storage/gambar/buku/'.$oldImage));
                }
            }
            $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $buku->update($input);
        return redirect()->route('buku.list', $inventaris->id)->with('success', 'Data inventaris berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $id_buku)
    {
        $buku = buku::find($id_buku);

        if($buku->image != null){
            if(file_exists(public_path('storage/gambar/buku/'.$buku->image))){
                unlink(public_path('storage/gambar/buku/'.$buku->image));
            }
        }

        $buku->delete();
        return redirect()->route('buku.list', $id)->with('success', 'Data inventaris berhasil dihapus');
    }
}
