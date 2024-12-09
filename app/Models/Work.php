<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Work extends Model
{
    use HasFactory;

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
            $model->profile_id = auth()->user()->profile->id;
        });
    }

    public function workCategory(): BelongsTo
    {
        return $this->belongsTo(WorkCategory::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function workTags(): BelongsToMany
    {
        return $this->belongsToMany(WorkTag::class);
    }
}
