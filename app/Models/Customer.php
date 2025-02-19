<?php

namespace App\Models;

class Customer extends BaseModel
{
    const STATUS_ACTIVE = 1;
    protected $fillable = [
        'name',
        'images',
        'content',
        'status',
        'order',
        'avatar',
    ];

    protected $casts = [
        'images' =>'json',
    ];
}
