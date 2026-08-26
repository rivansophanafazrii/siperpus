<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes; // Aktifkan SoftDeletes

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'nis_nip',
        'name',
        'jenis_kelamin',
        'tipe_anggota',
        'kelas',
        'no_telepon',
        'alamat',
        'foto',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}