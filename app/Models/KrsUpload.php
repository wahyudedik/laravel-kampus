<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KrsUpload extends Model
{
    protected $fillable = [
        'student_id',
        'semester',
        'academic_year',
        'file_path',
        'upload_date',
        'status',
    ];

    protected $casts = [
        'upload_date' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
