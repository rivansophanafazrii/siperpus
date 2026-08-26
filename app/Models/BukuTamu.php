<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    use HasFactory;

    // Menyesuaikan nama tabel di database
    protected $table = 'buku_tamu';

    // Mengizinkan kolom-kolom ini diisi secara massal
    protected $fillable = [
        'nama',
        'kelas_instansi',
        'tujuan',
        'keterangan',
    ];
}
