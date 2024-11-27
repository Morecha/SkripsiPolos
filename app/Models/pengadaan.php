<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengadaan extends Model
{
    use HasFactory;
    protected $table = 'pengadaans';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'id_inventaris',
        'judul',
        'pengarang',
        'penerbit',
        'kode_ddc',
        'status',
        'deskripsi',
        'eksemplar',
        'diterima',
    ];
}
