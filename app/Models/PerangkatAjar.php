<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatAjar extends Model
{
    protected $table = 'perangkat_ajars';

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'nama_perangkat_ajar',
        'mata_kuliah',
        'semester',
        'tahun_ajaran', //2024/2025
        'file_perangkat_ajar', //bentuk PDF
    ];

    protected $casts = [
        'tahun_ajaran' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'user_id' => 'integer',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
