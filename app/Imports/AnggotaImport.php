<?php

namespace App\Imports;

use App\Models\anggota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnggotaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $nisFromExcel = $rows->pluck(2)->toArray();

        foreach ($rows as $index => $row) {
            $validator = Validator::make($row->toArray(), [
                0 => 'required|string',  // name
                1 => 'required|integer', // angkatan
                2 => 'required|integer', // NIS
                3 => 'required|string',  // alamat
                4 => 'nullable|date',    // tanggal_lahir
                5 => 'required|in:aktif,non-aktif', // status
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages([
                    'error' => 'Kesalahan format data pada baris ' . ($index + 1) . ': ' . implode(', ', $validator->errors()->all()),
                ]);
            }
        }

        $duplicateInExcel = array_diff_key($nisFromExcel, array_unique($nisFromExcel));
        if (!empty($duplicateInExcel)) {
            throw ValidationException::withMessages([
                'error' => 'Duplikasi NIS ditemukan di file Excel: ' . implode(', ', $duplicateInExcel),
            ]);
        }

        $duplicateInDatabase = Anggota::whereIn('NIS', $nisFromExcel)->pluck('NIS')->toArray();
        if (!empty($duplicateInDatabase)) {
            throw ValidationException::withMessages([
                'error' => 'Duplikasi NIS ditemukan dengan data yang sudah ada di database: ' . implode(', ', $duplicateInDatabase),
            ]);
        }

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
