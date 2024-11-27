<?php

namespace App\Imports;

use App\Models\anggota;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnggotaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            anggota::create([
                'name' => $row[0],
                'angkatan' => $row[1],
                'NIS' => $row[2],
                'alamat' => $row[3],
                'tanggal_lahir' => $row[4],
                'status' => $row[5],
            ]);
        }
    }
}
