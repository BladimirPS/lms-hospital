<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'subdirection_id'])]
class Section extends Model
{
    public function subdirection(): BelongsTo
    {
        return $this->belongsTo(Subdirection::class);
    }
}
