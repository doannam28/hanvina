<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends BaseModel
{
    protected $fillable = [
        'phone',
    ];
}
