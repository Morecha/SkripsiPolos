<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\inventaris;
use App\Models\peminjaman;
use App\Models\pengadaan;
use App\Models\pivot;
use App\Models\presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $buku = buku::all()->count();
        $inventaris = inventaris::all()->count();
        $anggota = anggota::all()->count();
        $pengadaan = pengadaan::all()->count();

        // logika tabel peminjaman
        $tabel_peminjaman = Peminjaman::select('*', DB::raw('DATE_ADD(created_at, INTERVAL lama_peminjaman DAY) as due_date'))
                            ->orderBy('due_date', 'asc')
                            ->limit(20)
                            ->get();
        foreach($tabel_peminjaman as $p){
            if($p['id_user'] != null){
                $p['jenis_peminjaman'] = 'kelompok';
                $p['username'] = User::find($p['id_user'])->name;
            }elseif($p['id_anggota'] != null){
                $p['jenis_peminjaman'] = 'individu';
                $p['username'] = anggota::find($p['id_anggota'])->name;
            }
            $p['jumlah_buku'] = pivot::where('id_peminjaman', $p['id'])->count();
        }

        //logika grafik
        //label
        $tanggalHariini = now();
        $tanggalLalu = $tanggalHariini->copy()->subDays(15);
        $tanggalLaluFirst = $tanggalLalu->copy();
        $tanggalArray = [];


        while($tanggalLalu <= $tanggalHariini){
            $tanggalArray[] = $tanggalLalu->format('d-m-Y');
            $tanggalLalu->addDay();
        }

        //peminjaman 15 hari terakhir
        $peminjaman = peminjaman::whereBetween('created_at', [$tanggalLaluFirst->startOfDay(), $tanggalHariini->endOfDay()])->get();
        $peminjamanPerHari = [];
        foreach($tanggalArray as $t){
            $tanggalFormat = Carbon::createFromFormat('d-m-Y', $t)->format('Y-m-d');
            $jumlahPeminjaman = $peminjaman->filter(function ($item) use ($tanggalFormat) {
                // Format created_at menjadi 'Y-m-d' dan bandingkan hanya tanggalnya
                return $item->created_at->format('Y-m-d') == $tanggalFormat;
                })->count();
            $peminjamanPerHari[] = $jumlahPeminjaman;
        }

        //pengunjung 15 hari terakhir
        $pengunjung = presensi::whereBetween('created_at', [$tanggalLaluFirst->startOfDay(), $tanggalHariini->endOfDay()])->get();
        $pengunjungPerHariKelompok = [];
        $pengunjungPerHariIndividu = [];
        $pengunjungPerHari = [];
        foreach($tanggalArray as $t){
            $tanggalFormat = Carbon::createFromFormat('d-m-Y', $t)->format('Y-m-d');
            //jumlah kelompok
            $jumlahPengunjungKelompok = $pengunjung->filter(function ($item) use ($tanggalFormat) {
                // Format created_at menjadi 'Y-m-d' dan bandingkan hanya tanggalnya
                return $item->created_at->format('Y-m-d') == $tanggalFormat;})
                ->where('status_presensi', 'kelompok')
                ->sum('jumlah');
            $pengunjungPerHariKelompok[] = $jumlahPengunjungKelompok;
            //jumlah individu
            $jumlahPengunjungIndividu = $pengunjung->filter(function ($item) use ($tanggalFormat) {
                // Format created_at menjadi 'Y-m-d' dan bandingkan hanya tanggalnya
                return $item->created_at->format('Y-m-d') == $tanggalFormat;})
                ->where('status_presensi', 'individu')
                ->sum('jumlah');
            $pengunjungPerHariIndividu[] = $jumlahPengunjungIndividu;
        }

        foreach($pengunjungPerHariKelompok as $i => $p){
            $pengunjungPerHari[] = $p + $pengunjungPerHariIndividu[$i];
        }

        $chartData = [
            'label' => $tanggalArray,
            'peminjaman' => [
                'label' => 'Peminjaman',
                'data' => $peminjamanPerHari
            ],
            'kunjungan' => [
                'label' => 'kunjungan',
                'data' => $pengunjungPerHari
            ]
        ];

        return view('admin.dashboard', compact('buku','inventaris','anggota','pengadaan','peminjaman','tabel_peminjaman','chartData'));
    }

    public function profile()
    {
        return view('admin.profile.settings');
    }

    public function updateGeneral(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = User::find(Auth::user()->id);
        // dd($user->id);
        $input = $request->all();

        $logika = User::where('email', $input['email'])
                ->where('id', '!=', $user->id)
                ->first();

        if($logika != null){
            // dd('sudah ada');
            return redirect()->back()->with('error', 'Email sudah terdaftar');
        }

        if($request->file('image')) {

            $destinationPath = 'gambar/profil';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();

            if($user->image != null){
                $oldImage = $user->image;
                if(file_exists(public_path('storage/'.$destinationPath.'/'.$oldImage))){
                    File::delete(public_path('storage/'.$destinationPath.'/'.$oldImage));
                }
            }

            $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
            $input['image'] = "$profileImage";
        }else {
            unset($input['image']);
        }

        $user->update($input);
        return redirect()->back()->with('success', 'Profile berhasil diubah');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|min:6',
        ]);

        if(!Hash::check($request->password, Auth::user()->password)){
            return redirect()->back()->with('error', 'Old Password doesnt match');
        }

        if($request->new_password != $request->confirm_new_password){
            return redirect()->back()->with('error', 'the new password field doesnt match with the confirm new password field');
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
            ]);

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}

