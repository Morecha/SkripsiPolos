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

    public function jenisPeminjaman(){
        if ($this->id_anggota == null){
            return 'kelompok';
        }elseif ($this->id_user == null){
            return 'individu';
        }
    }

    public function getjenisPeminjamanAttribute(){
        if ($this->id_anggota == null){
            return 'kelompok';
        }elseif ($this->id_user == null){
            return 'individu';
        }
    }

    public function getNamaPeminjamanAttribute(){
        $data = $this->jenisPeminjaman === 'kelompok'
        ? User::find($this->id_user)?->name
        : anggota::find($this->id_anggota)?->name;
        return $data;
    }

    // public function namaPeminjaman(){
    //     if ($this->id_anggota == null){
    //         $this->id_user = User::find($this->id_user)?->name;
    //     }elseif ($this->id_user == null){
    //         $this->id_anggota = anggota::find($this->id_anggota)?->name;
    //     }
    // }

    public function getDueDateAttribute(){
        $data = $this->created_at->addDays($this->lama_peminjaman);
        return $data;
    }

    public function getTenggatWaktuAttribute()
    {
        $hingga = $this->due_date;
        $tenggat = now()->diff($hingga);
        $tanda = $tenggat->invert ? '-' : '';

        return "{$tanda} {$tenggat->d} hari {$tenggat->h} jam {$tenggat->i} menit {$tenggat->s} detik";
    }
}
