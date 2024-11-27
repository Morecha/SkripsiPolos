<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presensi extends Model
{
    use HasFactory;
    protected $table = 'presensis';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'status_presensi',
        'id_anggota',
        'id_user',
        'jumlah',
        'keterangan',
    ];
}
