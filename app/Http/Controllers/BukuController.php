<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\inventaris;
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super-admin');
    }

    public function generate_buku($id){
        $inventaris = inventaris::find($id);
        $buku = buku::where('id_inven', $id)->get();
        // 370(klasifikasi), sum(tajuk_buku, 3 huruf pertama nama pengarang), p(1 huruf judul),
        $kode_ddc = $inventaris['kode_ddc'];
        $tajuk_buku = substr($inventaris['pengarang'], 0, 3);
        $judul = substr($inventaris['judul'], 0, 1);
        // $kode_buku = $kode_ddc."-".$tajuk_buku."-".$judul."-"."1";

        //cek apakah ada nomor buku atau belum, jika belum silahkan tambahkan dahulu
        if($inventaris['kode_ddc'] == null){
            return redirect()->back()->with('warning', 'Tidak Ditemukan Kode Buku, Silahkan tambahkan terlebih dahulu!');
        }

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
        }else{
            //klo inven telah memiliki buku sebelumnya di dalamnya
            $string = $buku->last()->kode_buku;
            $pisah = explode('-', $string);
            $akhir = intval($pisah[3])+1;

            if($kode_ddc!=$pisah[0] || $tajuk_buku!=$pisah[1] || $judul!=$pisah[2])
            {
                //kondisi klo disana regenerate tetapi kode invennya beda
                //harus cek posisi buku (agar tidak crash dengan buku yang dipinjam)
                $diluar = $buku->filter(function ($item) {
                    return $item->posisi != 'ada' || $item->posisi != 'dimusnahkan';
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
                    return back()->with('error', 'Terdapat buku yang dipinjam atau hilang');
                }
            }

                //Tambahkan buku baru
                $banyak = $inventaris['eksemplar'] - $buku->count();
                // dd($banyak, $akhir,$inventaris['eksemplar']);
                for($i=$akhir; $i<$akhir+$banyak; $i++){
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
        return redirect()->route('inventaris.list')->with('success', 'Data Buku berhasil digenerate');
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
        // dd(response()->view('admin.inventaris.list-cetak', compact('data', 'id'), 200));
        return view('admin.inventaris.list-cetak', compact('data','id'));
    }

    public function cetak(Request $request, $id)
    {
        $inventaris = inventaris::find($id);
        if(count($request->all()) <= 1){
            return redirect()->route('buku.list_cetak', $id)->with('error', 'Tidak ada buku yang dipilih');
            // dd($response->status(), $response->getTargetUrl(), $response, session()->all());
        }

        $kode = $request->all();
        unset($kode['_token']);
        $data = [];
        // dd($kode);
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
        $pdf = Pdf::loadView('admin.laporan.cetakBuku', compact('data','kode'));
        return $pdf->stream($inventaris['judul'].'.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pemusnahan(string $id, string $id_buku)
    {
        $data = buku::find($id_buku);

        if($data['posisi'] != 'ada' && 'dimusnahkan'){
            return redirect()->back()->with('error', 'Buku tidak berada diperpustakaan atau telah berhasil dimusnahkan');
        }

        $inventaris = inventaris::find($id);

        return view('admin.inventaris.buku.pemusnahan', compact('data', 'inventaris'));
    }

    public function pemusnahan_update(Request $request, string $id, string $id_buku){
        $request->validate([
            'status' => 'required',
            'keterangan' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = buku::find($id_buku);

        $input = $request->all();
        $input['posisi'] = 'dimusnahkan';

        if($request->file('image')){
            $destinationPath = 'gambar/buku';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();

            if($data->image != null){
                $oldImage = $data->image;
                if(file_exists(public_path('storage/gambar/buku/'.$oldImage))){
                    unlink(public_path('storage/gambar/buku/'.$oldImage));
                }
            }

            $request->file('image')->storeAs($destinationPath, $profileImage,'public');
            $input['image'] = $profileImage;
        }else{
            unset($input['image']);
        }

        $data->update($input);
        return redirect()->route('buku.list', $id)->with('success', 'Data Buku berhasil dimusnahkan');
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id, string $id_buku){
        $data = buku::find($id_buku);
        $inventaris = inventaris::find($id);
        return view('admin.inventaris.buku.detail', compact('data', 'inventaris'));
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
        return redirect()->route('buku.list', $inventaris->id)->with('success', 'Data Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $id_buku)
    {
        $buku = buku::find($id_buku);
        if($buku['posisi'] != 'ada'){
            return redirect()->back()->with('error', 'Buku tidak berada diperpustakaan');
        }

        if($buku->image != null){
            if(file_exists(public_path('storage/gambar/buku/'.$buku->image))){
                unlink(public_path('storage/gambar/buku/'.$buku->image));
            }
        }

        $buku->delete();
        return redirect()->route('buku.list', $id)->with('success', 'Data Buku berhasil dihapus');
    }
}
