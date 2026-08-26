<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
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
}
