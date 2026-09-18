<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiplomaSettings extends Model
{
    use HasFactory;

    protected $table = 'diploma_settings';

    public $timestamps = false;

    protected $fillable = [
        'signature_mode',
        'director_signature',
        'hr_signature',
        'updated_by',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'signature_mode' => 'integer',
            'updated_at' => 'datetime',
        ];
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
