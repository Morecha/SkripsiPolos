<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Laporan;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Inventaris;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StoreLaporanTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use DatabaseTransactions;
    public function test_store_laporan_()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $data = [
            'jenis' => 'inventaris',
            'dari' => '2023-01-01',
            'hingga' => '2025-01-01',
            'keterangan' => 'Laporan Inventaris Tahun 2023 hingga 2025',
            'deskripsi' => 'Deskripsi Laporan Inventaris dari tahun 2023 hingga 2025',
        ];

        $response = $this->post(route('laporan.store'), $data);

        $pdfFileName = 'laporan-inventaris-'.date('Y-m-d-H-i').'.pdf';
        $this->assertFileExists(storage_path('app/public/laporan/'.$pdfFileName));

        $this->assertDatabaseHas('laporans', [
            'keterangan' => 'Laporan Inventaris Tahun 2023 hingga 2025',
            'file' => $pdfFileName
        ]);

        $response->assertStatus(200);
        // dd(session()->all(), $response->getStatusCode());
    }

    public function test_store_laporan_validation_fails()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $data = [
            'jenis' => '', // Kosong
            'dari' => '',
            'hingga' => '',
            'keterangan' => '',
        ];

        $response = $this->post(route('laporan.store'), $data);

        $response->assertSessionHasErrors(['jenis', 'dari', 'hingga', 'keterangan']);
        $response->assertStatus(302); // Redirect karena validasi gagal
    }
}
