<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diploma extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'attempt_id',
        'diploma_code',
        'manager_name',
        'obtained_score',
        'issued_at',
        'pdf_path',
    ];

    protected function casts(): array
    {
        return [
            'obtained_score' => 'decimal:2',
            'issued_at' => 'date',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(ExamAttempt::class, 'attempt_id');
    }
}
