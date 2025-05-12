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
use Spatie\Translatable\HasTranslations;

class Profile extends Model implements Viewable
{
    use InteractsWithViews;
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;


    protected $guarded = [];


    public $translatable = ['fullname'];

    protected $casts = [
        'categories' => 'array',
        'skills' => 'array',
        'languages' => 'array',
        'tools' => 'array',
        'interested' => 'array',
    ];


    public function getThumbnailImage()
    {
        // Check if avatar is null or empty
        if (is_null($this->avatar) || empty($this->avatar)) {
            return asset('assets/images/unset.jpg'); // Return default image if avatar is null or empty
        }

        // Return the avatar image URL from the public disk
        return \Storage::disk('public')->url($this->avatar);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar 
            ? '/storage/' . $this->avatar 
            : asset('assets/images/unset.jpg');
    }

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

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_id');
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

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
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
        return $this->belongsToMany(Skill::class, 'profile_skill', 'profile_id', 'skill_id');
    }

}
