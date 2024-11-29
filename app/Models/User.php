<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'foto',
        'role',
        'NIP',
        'tanggal_lahir',
        'image',
        'alamat',
        'jabatan',
        'status',
    ];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'id_user');
    }

    public function presensiKelompok()
    {
        return $this->hasMany(presensi::class, 'id_user');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
