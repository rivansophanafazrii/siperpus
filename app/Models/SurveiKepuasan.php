<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiKepuasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'peran',
        'kepuasan',
        'saran'
    ];
}
