<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemSettings extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'hospital_name',
        'logo',
        'max_video_size_mb',
        'max_pdf_size_mb',
        'updated_by',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'max_video_size_mb' => 'integer',
            'max_pdf_size_mb' => 'integer',
            'updated_at' => 'datetime',
        ];
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
