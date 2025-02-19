<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends BaseModel
{
    const DESTINATION = 6;
    const CATNEW = 1;
    const TIPS = 2;

    protected $fillable = ['name'];
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

}
