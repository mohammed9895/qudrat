<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Mix;

class Profile extends Model implements Viewable
{
    use InteractsWithViews;

    protected $guarded = [];

    protected $casts = [
        'categories' => 'array',
        'skills' => 'array',
        'languages' => 'array',
        'tools' => 'array',
        'interested' => 'array',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ProfileRating::class);
    }

    public function rating()
    {
        return $this->ratings->avg('rating');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }
}
