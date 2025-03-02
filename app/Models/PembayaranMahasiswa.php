<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranMahasiswa extends Model
{
    protected $table = 'pembayaran_mahasiswas';

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'nama_mahasiswa',
        'nim',
        'jenis_pembayaran',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran', // 1 = terbayar, 0 = belum terbayar
        'keterangan',
    ];

    protected $casts = [
            'tanggal_pembayaran' => 'datetime',
            'jumlah_pembayaran' => 'decimal:2',
            'user_id' => 'integer',
            'status_pembayaran' => 'boolean',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
