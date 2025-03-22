<?php

namespace App\Models;

use App\Models\AbsensiMahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        'mata_kuliah',
        'kode_kelas',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'dosen_pengajar',
        'pertemuan',
        'materi_perkuliahan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function mahasiswas()
    {
        return $this->hasMany(AbsensiMahasiswa::class);
    }
}
