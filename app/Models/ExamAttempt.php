<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\AttemptAnswer;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'attempt_number',
        'started_at',
        'finished_at',
        'score',
        'passed',
        'completed',
    ];

    protected function casts(): array
    {
        return [
            'attempt_number' => 'integer',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
            'score' => 'decimal:2',
            'passed' => 'boolean',
            'completed' => 'boolean',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function attemptAnswers(): HasMany
    {
        return $this->hasMany(AttemptAnswer::class, 'attempt_id');
    }

    public function diploma(): HasOne
    {
        return $this->hasOne(Diploma::class, 'attempt_id');
    }
    public function answers()
{
    return $this->hasMany(AttemptAnswer::class, 'attempt_id');
}
}
