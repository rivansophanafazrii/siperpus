<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_transaksi',
        'user_id', // Menggunakan user_id
        'buku_id',
        'tanggal_pinjam',
        'tenggat_waktu',
        'tanggal_dikembalikan',
        'status',
        'denda'
    ];

    // Relasi ke User (Anggota)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}

