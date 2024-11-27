<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
