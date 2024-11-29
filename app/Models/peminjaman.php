<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'id_anggota',
        'id_user',
        'status',
        'detail',
        'lama_peminjaman',
    ];

    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'id_anggota');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pivot()
    {
        return $this->hasMany(pivot::class, 'id_peminjaman');
    }

    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'pivot', 'id_peminjaman', 'id_buku');
    }
}
