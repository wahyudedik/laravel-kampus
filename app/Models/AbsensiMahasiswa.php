<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'absensi_mahasiswa';

    protected $fillable = [
        'absensi_id',
        'nim',
        'nama_mahasiswa',
        'status',
        'keterangan', //'hadir', 'izin', 'sakit', 'alpa'
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }
}
