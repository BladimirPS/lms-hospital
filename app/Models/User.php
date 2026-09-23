<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'system_code',
        'hospital_code',
        'dpi',
        'first_name',
        'middle_name',
        'third_name',
        'last_name',
        'second_last_name',
        'email',
        'password',
        'budget_line_id',
        'profile_photo',
        'signature_image',
        'hire_date',
        'position',
        'phone',
        'section_id',
        'active',
        'invitation_token',
        'invitation_sent_at',
        'last_access_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'hire_date' => 'date',
            'active' => 'boolean',
            'invitation_sent_at' => 'datetime',
            'last_access_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFilamentName(): string
    {
        return trim(collect([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
            $this->second_last_name,
        ])->filter()->implode(' '));
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (! $this->active) {
            return false;
        }

        return match ($panel->getId()) {
            'admin' => $this->hasAnyRole(['superadmin', 'encargado']),
            default => false,
        };
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function coursesCreated(): HasMany
    {
        return $this->hasMany(Course::class, 'creator_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function accessLogs(): HasMany
    {
        return $this->hasMany(AccessLog::class);
    }

    public function notificationLogs(): HasMany
    {
        return $this->hasMany(NotificationLog::class);
    }
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->system_code)) {
                $user->system_code = 'SYS-' . str_pad(
                    (User::max('id') ?? 0) + 1,
                    5,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function budgetLine(): BelongsTo
    {
        return $this->belongsTo(BudgetLine::class);
    }
}
