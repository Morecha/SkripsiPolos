<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\inventaris;
use App\Models\laporan;
use App\Models\peminjaman;
use App\Models\pivot;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Faker\Core\File;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(){
        $data = laporan::all();
        // dd($data);
        return view('admin.laporan.list',compact('data'));
    }

    public function create(){
        return view('admin.laporan.create');
    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
           'jenis' => 'required',
           'dari' => 'required',
           'hingga' => 'required',
           'keterangan' => 'required',
           'deskripsi' => 'nullable',
        ]);
        $dari = Carbon::parse($request['dari'])->startOfDay();
        $hingga = Carbon::parse($request['hingga'])->endOfDay();

        $base64TutWuri = $this->gambarencode64('/storage/gambar/logo/tut-wuri-handayani.png');
        $base64SD = $this->gambarencode64('/storage/gambar/logo/logo-sd.png');

        // dd($imagePathTutWuri);
        if($request['jenis'] == 'inventaris'){
            $totalInventaris = inventaris::all()->count();
            $totalBuku = buku::all()->count();
            $bukuInventaris = buku::with('inventaris.pengadaan')
                            ->whereBetween('created_at', [$dari, $hingga])
                            ->get();

            $dataInventarisBuku = [];
            $jumlahJenisPeriode = ['pengadaan'=>0,'sumbangan'=> 0] ;

            foreach ($bukuInventaris as $buku) {
                $inventaris = $buku->inventaris;
                // Cek apakah inventaris sudah ada di array berdasarkan ID-nya
                if (isset($dataInventarisBuku[$inventaris->id])) {
                    // Jika sudah ada, tambahkan 1 ke buku_count
                    $dataInventarisBuku[$inventaris->id]['buku_count']++;
                } else {
                    // Jika belum ada, tambahkan inventaris ke array dan set buku_count menjadi 1
                    $dataInventarisBuku[$inventaris->id] = $inventaris->toArray();
                    $dataInventarisBuku[$inventaris->id]['buku_count'] = 1;
                    //kalau tidak ada relasi ke pengadaan
                    if($dataInventarisBuku[$inventaris->id]['pengadaan'] != null){
                        $dataInventarisBuku[$inventaris->id]['tipe'] = 'Pengadaan';
                    }else{
                        $dataInventarisBuku[$inventaris->id]['tipe'] = 'Sumbangan';
                    }
                }
                $tipe = $dataInventarisBuku[$inventaris->id]['tipe'];
                $jumlahJenisPeriode[$tipe] += 1;
            }

            $jumlahInventarisBuku = $bukuInventaris->count();
            $inventarisDariPengadaan = inventaris::whereHas('pengadaan')->with(['pengadaan', 'buku'])->withCount('buku')->get();
            $inventarisTidakDariPengadaan = inventaris::whereDoesntHave('pengadaan')->with(['buku'])->withCount('buku')->get();

            $pdf = Pdf::loadView('admin.laporan.anggota',
            compact('totalInventaris','totalBuku','request','dataInventarisBuku','jumlahInventarisBuku','inventarisDariPengadaan','inventarisTidakDariPengadaan','jumlahJenisPeriode','base64TutWuri','base64SD'));
            $name = 'laporan-inventaris-'.date('Y-m-d-H-i').'.pdf';

        }elseif($request['jenis'] == 'peminjaman'){

            $total_peminjaman = peminjaman::all()->count();
            $total_pengembalian = peminjaman::where('status', 'kembali')->count();
            $total_buku_dipinjam = pivot::all()->count();
            $total_buku_hilang = buku::where('posisi', 'hilang')->count();

            $total_peminjaman_periode = peminjaman::whereBetween('created_at', [$dari, $hingga])->get()->count();
            $total_pengembalian_periode = peminjaman::where('status', 'kembali')->whereBetween('created_at', [$dari, $hingga])->get()->count();
            $total_buku_dipinjam_periode = pivot::whereBetween('created_at', [$dari, $hingga])->get()->count();
            $total_buku_hilang_periode = buku::where('posisi', 'hilang')->whereBetween('updated_at', [$dari, $hingga])->get()->count();

            $peminjaman = peminjaman::withCount('pivot')->where('status', 'dipinjam')->get();


            foreach($peminjaman as $p){
                $p['jenis_peminjaman'] = $p->jenisPeminjaman();
                $p->namaPeminjaman();
            }

            $pdf = Pdf::loadView('admin.laporan.peminjaman',
            compact('request','total_peminjaman','total_pengembalian','total_buku_dipinjam','total_buku_hilang','total_peminjaman_periode','total_pengembalian_periode','total_buku_dipinjam_periode','total_buku_hilang_periode','peminjaman','base64TutWuri','base64SD'));
            $name = 'laporan-peminjaman-'.date('Y-m-d-H-i').'.pdf';
        }

        $content = $pdf->download()->getOriginalContent();
        $input = [
            'file' => $name,
            'keterangan' => $request['keterangan'],
        ];
        laporan::create($input);
        Storage::put('public/laporan/'.$name, $content);
        return $pdf->stream('laporan.pdf');
    }

    public function destroy($id){
        $data = laporan::find($id);
        $path = public_path('/storage/laporan/'.$data->file);
        if(file_exists($path)){
            unlink($path);
        }
        $data->delete();
        return redirect()->route('laporan.list')->with('success', 'Data Berhasil Dihapus');
    }

    private function gambarencode64($gambar){
        $imagePath = public_path($gambar);
        if(!file_exists($imagePath)){
            return null;
        }
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $data = file_get_contents($imagePath);
        $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);
        return $base64;
    }
}
