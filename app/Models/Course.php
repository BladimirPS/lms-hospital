<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Enrollment;

class Course extends Model
{
    use HasFactory;

    protected static function booted(): void
{
    static::created(function (Course $course) {
        $course->exam()->firstOrCreate([]);
    });
}
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'type',
        'version',
        'parent_version_id',
        'is_free_choice',
        'generates_diploma',
        'minimum_score',
        'start_date',
        'due_date',
        'status',
        'creator_id',
    ];

    protected function casts(): array
    {
        return [
            'is_free_choice' => 'boolean',
            'generates_diploma' => 'boolean',
            'minimum_score' => 'integer',
            'start_date' => 'date',
            'due_date' => 'date',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function parentVersion(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'parent_version_id');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(Course::class, 'parent_version_id');
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'course_sections');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function questions()
    {
        return $this->hasManyThrough(
            \App\Models\Question::class,
            \App\Models\Exam::class,
            'course_id',
            'exam_id'
        );
    }

public function createEnrollmentsForSections(): void
{
    $sections = $this->sections()->with('users')->get();

    foreach ($sections as $section) {
        foreach ($section->users as $user) {
            Enrollment::firstOrCreate([
                'user_id'   => $user->id,
                'course_id' => $this->id,
            ], [
                'status'      => 'in_progress',
                'progress'    => 0,
                'enrolled_at' => now(),
                'start_date'  => $this->start_date,
                'due_date'    => $this->due_date,
            ]);
        }
    }
}
}
