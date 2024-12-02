<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\inventaris;
use Illuminate\Http\Request;
use App\Models\Post;

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

    public function list_buku(){
        $inventaris = inventaris::withCount('buku')->get();
        // dd($inventaris);
        return view('landing-page.list', compact('inventaris'));
    }
}
