<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => Status::class,
    ];

    protected static function booted()
    {
        static::creating(function($model) {
            $model->entity_id = auth()->user()->entity->id;
        });
    }

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function jobDepartment(): BelongsTo
    {
        return $this->belongsTo(JobDepartment::class)->where('status', Status::Active);
    }

    public function EmploymentType(): BelongsTo
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function EducationType(): BelongsTo
    {
        return $this->belongsTo(EducationType::class);
    }

    public function ExperienceLevel(): BelongsTo
    {
        return $this->belongsTo(ExperienceLevel::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tool::class);
    }
}
