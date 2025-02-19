<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourNote extends BaseModel
{
    protected $fillable = [
        'content',
        'tour_id',
        'note',
        'type',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
