<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'id_inven',
        'kode_buku',
        'keterangan',
        'posisi',
        'status',
        'image',
    ];

    public function inventaris()
    {
        return $this->belongsTo(inventaris::class, 'id_inven', 'id');
    }
}
