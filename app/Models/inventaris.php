<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventaris extends Model
{
    use HasFactory;
    protected $table = 'inventaris';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'judul',
        'pengarang',
        'penerbit',
        'kode_ddc',
        'status',
        'deskripsi',
        'eksemplar',
        'image',
    ];

    public function buku()
    {
        return $this->hasMany(buku::class, 'id_inven');
    }


    public function pengadaan()
    {
        return $this->hasMany(pengadaan::class, 'id_inventaris');
    }
}
