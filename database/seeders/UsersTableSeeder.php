<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Madda',
            'email' => 'ahmad_madda58@student.ub.ac.id',
            'password' => 'rahasia',
            'role' => 'PenanggungJawab',
            'NIP' => '123456789',
            'tanggal_lahir' => '2024-07-12',
            'alamat' => 'Jl. Raya Candi VB no.302',
            'jabatan' => 'Kepala Sekolah',
            'status' => 'aktif',
        ]);

        $user = User::create([
            'name' => 'Ahmad',
            'email' => 'ahmadmadda302@gmail.com',
            'password' => 'rahasia',
            'role' => 'Administrasi',
            'NIP' => '225150209111013',
            'tanggal_lahir' => '2024-07-12',
            'alamat' => 'Jl. Raya Candi VC no.220',
            'jabatan' => 'Administrasi Sekolah',
            'status' => 'aktif',
        ]);
    }
}
