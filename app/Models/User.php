<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'system_code',
    'hospital_code',
    'first_name',
    'middle_name',
    'third_name',
    'last_name',
    'second_last_name',
    'email',
    'password',
    'email_verified_at',
    'profile_photo',
    'signature_image',
    'hire_date',
    'position',
    'phone',
    'section_id',
    'active',
])]
#[Hidden(['password', 'remember_token', 'invitation_token'])]
class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<UserFactory> */
    use HasRoles, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'invitation_sent_at' => 'datetime',
            'last_access_at' => 'datetime',
            'hire_date' => 'date',
            'active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function canAccessPanel(Panel $panel): bool
{
    return $this->active && $this->hasRole('super_admin');
}

    public function getFilamentName(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
