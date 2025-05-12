<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'attachments' => 'array',
        'attachment_file_names' => 'array',
        'status' => Status::class,
    ];

    protected static function booted()
    {
        static::creating(function($model) {
            $model->profile_id = auth()->user()->profile->id ?? Profile::factory()->create()->id;
        });
    }

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function workCategory(): BelongsTo
    {
        return $this->belongsTo(WorkCategory::class);
    }

    public function workTags(): BelongsToMany
    {
        return $this->belongsToMany(WorkTag::class);
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
