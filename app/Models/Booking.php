<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends BaseModel
{
    protected $fillable = [
        'name',
        'phone',
        'date',
        'adult',
        'children',
        'tour_id',
        'status',
    ];

    /**
     * @return BelongsTo
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
