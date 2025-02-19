<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends BaseModel
{
    protected $fillable = [
        'name',
        'day',
        'order',
        'tour_id'
    ];

    /**
     * @return BelongsTo
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * @return HasMany
     */
    public function tourPrices(): HasMany
    {
        return $this->hasMany(TourPrice::class);
    }
}
