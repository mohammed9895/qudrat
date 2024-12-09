<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class MediaCenterPost extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title',
        'content',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(MediaCenterComment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getThumbnailImage()
    {
        $isUrl = str_contains($this->image, 'http');
        return $isUrl ? $this->image : \Storage::disk('public')->url($this->image);
    }
}
