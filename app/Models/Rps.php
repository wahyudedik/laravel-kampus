<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rps extends Model
{
    protected $fillable = [
        'user_id',
        'mata_kuliah',
        'semester',
        'tahun_ajaran',
        'file_rps',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
