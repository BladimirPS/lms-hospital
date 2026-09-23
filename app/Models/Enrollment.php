<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\ExamAttempt;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrolled_at',
        'completed_at',
        'status',
        'progress',
        'start_date',
        'due_date',
    ];

    protected function casts(): array
    {
        return [
            'enrolled_at' => 'datetime',
            'completed_at' => 'datetime',
            'progress' => 'integer',
            'start_date' => 'date',
            'due_date' => 'date',
        ];
    }

    public function getEffectiveStartDate()
    {
        return $this->start_date ?? $this->course->start_date;
    }

     public function getEffectiveDueDate()
    {
        return $this->due_date ?? $this->course->due_date;
    }

    public function isLocked(): bool
    {
        $dueDate = $this->getEffectiveDueDate();
        return $dueDate && $dueDate->isPast();
    }

    public function isNotStarted(): bool
    {
        $startDate = $this->getEffectiveStartDate();
        return $startDate && $startDate->isFuture();
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessonProgress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function examAttempts(): HasMany
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function diploma(): HasOne
    {
        return $this->hasOne(Diploma::class);
    }
    public function attempts()
{
    return $this->hasMany(ExamAttempt::class);
}
}
