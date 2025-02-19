<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourPrice extends BaseModel
{
    protected $fillable = [
        'price',
        'tour_id',
        'description',
        'days',
    ];
    protected $casts = [
        'days' => 'json',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
