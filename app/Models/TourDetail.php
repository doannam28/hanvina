<?php

namespace App\Models;

class TourDetail extends BaseModel
{
    protected $fillable = [
        'tour_id',
        'name',
        'description',
        'images',
        'type',
        'day',
        'note',
    ];

    const FEATURE = 'feature';
    const VEHICLE = 'vehicle';
    const FOOD = 'food';
    const HOTEL = 'hotel';

    protected $casts = [
        'images' => 'json',
    ];

    public function tour(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function getImagesAttribute()
    {
        $images = $this->attributes['images'] ? json_decode($this->attributes['images'], true)  : [];
        return $this->convertKey($images);
    }


}
