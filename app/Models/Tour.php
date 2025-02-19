<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'images',
        'status',
        'experience_title',
        'experience_video',
        'days',
        'meta',
    ];

    protected $casts = [
        'images' => 'json',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(TourDetail::class);
    }

    public function detailFeature(): HasMany
    {
        return $this->hasMany(TourDetail::class)->where('type', TourDetail::FEATURE);
    }

    public function detailVehicle(): HasMany
    {
        return $this->hasMany(TourDetail::class)->where('type', TourDetail::VEHICLE);
    }

    public function detailFood(): HasMany
    {
        return $this->hasMany(TourDetail::class)->where('type', TourDetail::FOOD);
    }


    public function detailHotel(): HasMany
    {
        return $this->hasMany(TourDetail::class)->where('type', TourDetail::HOTEL);
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class);
    }

    /**
     * @return HasMany
     */
    public function tourNotes(): HasMany
    {
        return $this->hasMany(TourNote::class);
    }

    public function tourPrices(): HasMany
    {
        return $this->hasMany(TourPrice::class);
    }


}
