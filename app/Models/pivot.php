<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pivot extends Model
{
    use HasFactory;
    protected $table = 'pivots';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'id_peminjaman',
        'id_buku',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(peminjaman::class, 'id_peminjaman');
    }

    public function buku()
    {
        return $this->belongsTo(buku::class, 'id_buku');
    }
}
