<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends BaseModel
{
    const HOME_PAGE = 'home-page';
    const ABOUT_PAGE = 'about';
    const CONTACT_PAGE = 'contact';
    const TOUR_PAGE = 'tour';

    const NEWS_PAGE = 'news';

    protected $casts = [
        'content' =>'json',
    ];
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    /**
     * @return BelongsToMany
     */
    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class);
    }

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * @return BelongsToMany
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }
}
