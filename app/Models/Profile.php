<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Mix;

class Profile extends Model implements Viewable
{
    use InteractsWithViews;
    use HasFactory;
    use SoftDeletes;

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

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function eductionType(): BelongsTo
    {
        return $this->belongsTo(EducationType::class);
    }

    public function employmentType(): BelongsTo
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function experienceLevel(): BelongsTo
    {
        return $this->belongsTo(ExperienceLevel::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function educations(): HasMany
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

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tool::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

}
