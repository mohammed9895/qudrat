<?php

namespace App\Models;

use App\Services\RecommendationService;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Profile extends Model implements Viewable
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithViews;
    use SoftDeletes;

    public $translatable = ['fullname'];

    protected $guarded = [];

    protected $casts = [
        'categories' => 'array',
        'skills' => 'array',
        'languages' => 'array',
        'tools' => 'array',
        'interested' => 'array',
    ];

    public function getAvatarUrlAttribute()
    {
        return $this->avatar
            ? '/storage/'.$this->avatar
            : asset('assets/images/unset.jpg');
    }

    public function user(): BelongsTo
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
        return $this->belongsToMany(Category::class, 'category_profile');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function rating()
    {
        return $this->ratings->avg('rating');
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getSectionRecommendation(string $section): array
    {
        $lastUpdatedAt = match ($section) {
            'educations' => $this->educations()->max('updated_at') ?? $this->updated_at,
            'skills' => $this->skills()->get()->max(fn ($skill) => $skill->pivot->updated_at ?? null)
                ?? $this->updated_at,
            'experiences' => $this->experiences()->max('updated_at') ?? $this->updated_at,
            'certificates' => $this->certificates()->max('updated_at') ?? $this->updated_at,
            'courses' => $this->courses()->max('updated_at') ?? $this->updated_at,
            'achievements' => $this->achievements()->max('updated_at') ?? $this->updated_at,
            'languages' => $this->skills()->get()->max(fn ($skill) => $skill->pivot->updated_at ?? null)
                ?? $this->updated_at,
            'tools' => $this->skills()->get()->max(fn ($skill) => $skill->pivot->updated_at ?? null)
                ?? $this->updated_at,
            'interests' => $this->skills()->get()->max(fn ($skill) => $skill->pivot->updated_at ?? null)
                ?? $this->updated_at,
            'works' => $this->works()->max('updated_at') ?? $this->updated_at,
            'ratings' => $this->ratings()->max('updated_at') ?? $this->updated_at,
            default => $this->updated_at,
        };

        $recommendation = $this->recommendations()
            ->where('section', $section)
            ->latest('generated_at')
            ->first();

        $locales = ['ar', 'en'];

        // ✅ Rate limit check
        if (! $this->canRequestRecommendations()) {
            // Fallback to latest available recommendation
            return $recommendation
                ? [
                    'ar' => $recommendation->getTranslation('recommendation', 'ar'),
                    'en' => $recommendation->getTranslation('recommendation', 'en'),
                ]
                : [
                    'ar' => ['error' => __('general.ai.limit_exceeded')],
                    'en' => ['error' => __('general.ai.limit_exceeded')],
                ];
        }

        // Check if already up to date and has both translations
        $needsUpdate = false;
        if ($recommendation && $recommendation->profile_last_updated_at == $lastUpdatedAt) {
            foreach ($locales as $locale) {
                if (! $recommendation->hasTranslation('recommendation', $locale)) {
                    $needsUpdate = true;
                    break;
                }
            }

            if (! $needsUpdate) {
                return [
                    'ar' => $recommendation->getTranslation('recommendation', 'ar'),
                    'en' => $recommendation->getTranslation('recommendation', 'en'),
                ];
            }
        }

        // 🚀 Make external API request
        $responses = [];
        foreach ($locales as $locale) {
            $responses[$locale] = RecommendationService::getSectionRecommendation(
                $this->toRecommendationArray(), $section, $locale
            );
        }

        // ✅ Increment request count if successful
        if (! isset($responses['ar']['error']) && ! isset($responses['en']['error'])) {
            $this->incrementRecommendationRequestCount();
        }

        // Save new or updated record
        if (! $recommendation) {
            $this->recommendations()->create([
                'section' => $section,
                'generated_at' => now(),
                'profile_last_updated_at' => $lastUpdatedAt,
                'recommendation' => $responses,
            ]);
        } else {
            foreach ($responses as $locale => $data) {
                if (! isset($data['error'])) {
                    $recommendation->setTranslation('recommendation', $locale, $data);
                }
            }
            $recommendation->generated_at = now();
            $recommendation->profile_last_updated_at = $lastUpdatedAt;
            $recommendation->save();
        }

        return $responses;
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'profile_skill', 'profile_id', 'skill_id');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ProfileRating::class);
    }

    public function recommendations()
    {
        return $this->hasMany(ProfileRecommendation::class);
    }

    public function canRequestRecommendations(): bool
    {
        $key = 'profile:'.$this->id.':recommendation_requests';

        return Cache::get($key, 0) < 100;
    }

    public function toRecommendationArray(): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position,
            'address' => $this->address,
            'avatar' => $this->getThumbnailImage(),
            'video' => $this->video ? asset('storage/'.$this->video) : null,
            'website' => $this->website,
            'social' => [
                'facebook' => $this->social_facebook,
                'instagram' => $this->social_instagram,
                'x' => $this->social_x,
                'linkedin' => $this->social_linkedin,
                'pinterest' => $this->social_pinterest,
                'stackoverflow' => $this->social_stackoverflow,
                'whatsapp' => $this->social_whatsapp,
            ],
            'bio' => $this->bio,
            'skills' => $this->skills()->pluck('name')->toArray(),
            'languages' => $this->languages()->pluck('name')->toArray(),
            'tools' => $this->tools()->pluck('name')->toArray(),
            'interests' => $this->interests()->pluck('name')->toArray(),
            'views_count' => $this->views->count(),
            'works_count' => $this->works->count(),
            'works' => $this->works->map(fn ($work) => [
                'title' => $work->title,
                'cover' => asset('storage/'.$work->cover),
                'category' => $work->workCategory->name ?? null,
                'skills' => $work->skills->pluck('name')->toArray(),
                'created_at' => $work->created_at->toDateTimeString(),
            ]),
            'educations' => $this->educations->map(fn ($edu) => [
                'education_type' => $edu->educationType->name ?? null,
                'field' => $edu->fieldOfStudy->name ?? null,
                'sub_field' => $edu->fieldOfStudyChild->name ?? null,
                'school' => $edu->school->name ?? null,
                'start_date' => $edu->start_date,
                'end_date' => $edu->end_date,
            ]),
            'experiences' => $this->experiences->map(fn ($exp) => [
                'position' => $exp->position,
                'company' => $exp->company,
                'start_date' => $exp->start_date,
                'end_date' => $exp->is_current ? 'Present' : $exp->end_date,
            ]),
            'certificates' => $this->certificates->map(fn ($cert) => [
                'title' => $cert->title,
                'organization' => $cert->organization,
                'file' => $cert->certificate_file ? asset('storage/'.$cert->certificate_file) : null,
            ]),
            'courses' => $this->courses->map(fn ($course) => [
                'title' => $course->title,
                'organization' => $course->organization,
                'file' => $course->course_file ? asset('storage/'.$course->course_file) : null,
            ]),
            'achievements' => $this->achievements->map(fn ($ach) => [
                'title' => $ach->title,
                'description' => $ach->description,
            ]),
            'ratings' => [],
        ];
    }

    public function getThumbnailImage()
    {
        // Check if avatar is null or empty
        if (is_null($this->avatar) || empty($this->avatar)) {
            return asset('assets/images/unset.jpg'); // Return default image if avatar is null or empty
        }

        // Return the avatar image URL from the public disk
        return Storage::disk('public')->url($this->avatar);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tool::class);
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class);
    }

    public function incrementRecommendationRequestCount(): void
    {
        $key = 'profile:'.$this->id.':recommendation_requests';

        // Set expiration to reset count daily
        Cache::add($key, 0, now()->addDay()); // ensure key exists
        Cache::increment($key);
    }
}
