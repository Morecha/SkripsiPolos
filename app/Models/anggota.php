<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class anggota extends Model
{
    use HasFactory;
    protected $table = 'anggotas';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'name',
        'angkatan',
        'NIS',
        'alamat',
        'tanggal_lahir',
        'status',
    ];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'id_anggota');
    }


    public function presensiIndividu()
    {
        return $this->hasMany(presensi::class, 'id_anggota');
    }

    public function toggleStatus()
    {
        if ($this->status == 'aktif') {
            $this->status = 'non-aktif';
        } elseif ($this->status == 'non-aktif') {
            $this->status = 'aktif';
        }

        $this->save();
    }
}
