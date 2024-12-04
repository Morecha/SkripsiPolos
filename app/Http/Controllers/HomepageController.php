<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\inventaris;
use App\Models\pivot;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\presensi;

class HomepageController extends Controller
{
    public function index()
    {
        $buku = buku::all()->count();
        $buku_tersedia = buku::where('posisi', 'ada')->count();
        $buku_dipinjam = buku::where('posisi','!=', 'ada')->count();

        $inventarisRekomendasi = inventaris::with(['buku.pivot'])
                                ->get()
                                ->map(function ($inventaris) {
                                    // Hitung total peminjaman dari semua buku di inventaris ini
                                    $totalPeminjaman = $inventaris->buku->sum(function ($buku) {
                                        return $buku->pivot->count(); // Hitung jumlah peminjaman setiap buku
                                    });

                                    $inventaris['total_peminjaman'] = $totalPeminjaman;
                                    return $inventaris;
                                })
                                ->sortByDesc('total_peminjaman') // Urutkan berdasarkan total peminjaman
                                ->take(6);
        // dd($inventarisRekomendasi);
        return view('landing-page.searching', compact('buku','buku_tersedia','buku_dipinjam','inventarisRekomendasi'));
    }

    public function list_buku(Request $request){
        $inventaris = inventaris::withCount('buku')->get();
        // dd($request->input('search'));
        if($request->input('search') != null){
            $inven_cari = inventaris::where('judul','like','%'.$request->input('search').'%')->get();
            if($inven_cari->isEmpty() == false){
                // dd('ada');
                return view('landing-page.list', compact('inventaris','inven_cari'));
            }else{
                // dd('tidak ada');
                redirect()->route('landing-page.list')->with('error', 'Data tidak ditemukan');
                // return view('landing-page.list', compact('inventaris','inven_cari'))->with('error', 'Data tidak ditemukan');
            }
        }
        $inven_cari = null;
        return view('landing-page.list', compact('inventaris','inven_cari'));
    }

    public function detail_buku($id){
        $inventaris = inventaris::withCount('buku')->find($id);
        $id_inventaris = $inventaris->id;
        $pivot = pivot::with([
                    'buku.inventaris',          // Relasi ke DataInventaris melalui DataBuku
                ])
                ->whereHas('buku.inventaris', function ($query) use ($id_inventaris) {
                    $query->where('id', $id_inventaris); // Filter hanya inventaris tertentu
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        // dd($pivots);
        return view('landing-page.detail', compact('inventaris','pivot'));
    }

    public function presensi_individu(Request $request){
        if($request->input('search') != null){
            $anggota_cari = anggota::where('name','like','%'.$request->input('search').'%')->get();
        } else{
            $anggota_cari = null;
        }
        // dd($anggota_cari);
        return view('landing-page.presensi', compact('anggota_cari'));
    }

    public function store_presensi_individu(string $id){
        $absen = anggota::find($id);
        if($absen){
            $input = [
                'id_anggota' => $id,
                'jumlah' => 1,
                'stats_presensi' => 'individu',
                'keterangan' => 'absen individu',
            ];
        }
        // dd($input);
        presensi::create($input);
        return redirect()->route('landing-page.presensi.individu')->with('success', 'Data presensi individu berhasil ditambahkan');
    }
}
