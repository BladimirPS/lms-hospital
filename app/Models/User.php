<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
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
            'email_verified_at'  => 'datetime',
            'invitation_sent_at' => 'datetime',
            'last_access_at'     => 'datetime',
            'hire_date'          => 'date',
            'password'           => 'hashed',
            'active'             => 'boolean',
        ];
    }

    // Requerido por HasName
    public function getFilamentName(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    // Requerido por FilamentUser
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('superadmin') || $this->hasRole('encargado');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'creator_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
