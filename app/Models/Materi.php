<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materis';

    protected $fillable = [
        'judul_materi',
        'mata_kuliah',
        'semester',
        'tahun_ajaran',
        'deskripsi',
        'file_materi'
    ];

    protected $casts = [
        'tahun_ajaran' => 'date',
    ];
}
