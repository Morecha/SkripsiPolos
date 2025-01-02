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

    public function getAvailabilityAttribute()
    {
        $posisi_buku = $this->buku->posisi;
        $kondisi_pivot = $this->status;

        if($kondisi_pivot == 'dipinjam'){
            return 'available';
        }elseif($kondisi_pivot == 'kembali'){
            if ($posisi_buku == 'ada') {
                return 'available';
            } else {
                return 'unavailable';
            }
        }elseif($kondisi_pivot == 'hilang'){
            return 'available';
        }
    }
}
