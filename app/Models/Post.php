<?php

namespace App\Models;

class Post extends BaseModel
{
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'title',
        //'date_create',
        //'position',
        'content',
        'images',
        'meta',
        'slug',
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
