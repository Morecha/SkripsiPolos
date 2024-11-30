<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

Route::get('/', function () {return view('welcome');})->name('home');
Route::get('/search', function () {return view('landing-page.searching');});
Route::get('/list', function () {return view('landing-page.list');});
Route::get('/detail', function () {return view('landing-page.detail');});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating'])->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {return view('admin.dashboard');})->name('dashboard');

    // users
    Route::get('/users', [UserController::class, 'index'])->name('users.list');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/profile',[DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}/update', [DashboardController::class, 'updateGeneral'])->name('profile.update');
    Route::post('/profile/{id}/update-password', [DashboardController::class, 'updatePassword'])->name('profile.update-password');

    //anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.list');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::post('/anggota/{id}/update', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::post('/anggota/{id}/delete', [AnggotaController::class, 'destroy'])->name('anggota.delete');
    Route::get('/anggota/masal', [AnggotaController::class, 'create_masal'])->name('anggota.create_masal');
    Route::post('/anggota/masal/store', [AnggotaController::class, 'store_masal'])->name('anggota.store_masal');


    //presensi_kelompok
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.list');
    Route::get('/presensi/create-kelompok', [PresensiController::class, 'create_kelompok'])->name('presensi.kelompok.create');
    Route::post('/presensi/store-kelompok', [PresensiController::class, 'store_kelompok'])->name('presensi.kelompok.store');
    Route::get('/presensi/{id}/edit', [PresensiController::class, 'edit'])->name('presensi.edit');
    Route::post('/presensi/{id}/update', [PresensiController::class, 'update'])->name('presensi.update');
    Route::post('/presensi/{id}/delete', [PresensiController::class, 'destroy'])->name('presensi.delete');
    //belum
    Route::get('/presensi/create-individu', [PresensiController::class, 'create_individu'])->name('presensi.individu.create');
    Route::post('/presensi/store-individu', [PresensiController::class, 'store_individu'])->name('presensi.individu.store');

    //pengadaan
    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.list');
    Route::get('/pengadaan/create', [PengadaanController::class, 'create'])->name('pengadaan.create');
    Route::post('/pengadaan/store', [PengadaanController::class, 'store'])->name('pengadaan.store');
    Route::get('/pengadaan/{id}/edit', [PengadaanController::class, 'edit'])->name('pengadaan.edit');
    Route::post('/pengadaan/{id}/update', [PengadaanController::class, 'update'])->name('pengadaan.update');
    Route::post('/pengadaan/{id}/delete', [PengadaanController::class, 'destroy'])->name('pengadaan.delete');
    Route::get('/pengadaan/{id}/inventaris', [PengadaanController::class, 'inventaris'])->name('pengadaan.inventaris');
    Route::post('/pengadaan/{id}/inventaris/store', [PengadaanController::class, 'inventaris_store'])->name('pengadaan.inventaris.store');

    //inventaris
    Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.list');
    Route::get('/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::post('/inventaris/store', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('/inventaris/{id}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit');
    Route::post('/inventaris/{id}/update', [InventarisController::class, 'update'])->name('inventaris.update');
    Route::post('/inventaris/{id}/delete', [InventarisController::class, 'destroy'])->name('inventaris.delete');
    Route::post('/inventaris/{id}/generate', [BukuController::class, 'generate_buku'])->name('inventaris.generate');

    // buku
    Route::get('/inventaris/{id}/list-buku', [BukuController::class, 'index'])->name('buku.list');
    Route::get('/inventaris/{id}/create-buku', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/inventaris/{id}/store-buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/inventaris/{id}/edit-buku/{id_buku}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::post('/inventaris/{id}/update-buku/{id_buku}', [BukuController::class, 'update'])->name('buku.update');
    Route::post('/inventaris/{id}/delete-buku/{id_buku}', [BukuController::class, 'destroy'])->name('buku.delete');

    //cetak nomor buku
    Route::get('/inventaris/{id}/list-cetak', [BukuController::class, 'list_cetak'])->name('buku.list_cetak');
    Route::post('/inventaris/{id}/cetak-no-buku', [BukuController::class, 'cetak'])->name('buku.cetak');

    //peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.list');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::post('/peminjaman/{id}/update', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::post('/peminjaman/{id}/delete', [PeminjamanController::class, 'destroy'])->name('peminjaman.delete');

    Route::get('/peminjaman/{id}/detail', [PeminjamanController::class, 'detail'])->name('peminjaman.detail');
    Route::get('/pengembalian/{id}/detail', [PeminjamanController::class, 'detail_pengembalian'])->name('pengembalian.detail');

    Route::get('/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('pengembalian.list');
    Route::get('/pengembalian/{id}', [PeminjamanController::class, 'pengembalian_create'])->name('pengembalian.create');
    Route::post('/pengembalian/{id}/store', [PeminjamanController::class, 'pengembalian_store'])->name('pengembalian.store');
    Route::get('/pengembalian/{id}/edit', [PeminjamanController::class, 'pengembalian_edit'])->name('pengembalian.edit');
    Route::post('/pengembalian/{id}/update', [PeminjamanController::class, 'pengembalian_update'])->name('pengembalian.update');
    Route::post('/pengembalian/{id}/delete', [PeminjamanController::class, 'pengembalian_destroy'])->name('pengembalian.delete');
});
