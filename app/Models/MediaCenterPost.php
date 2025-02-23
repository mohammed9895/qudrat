<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class MediaCenterPost extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = [
        'title',
        'content',
        'image',
    ];

    protected $guarded = [];

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

        return ! $this->image ? asset('assets/images/unset.jpg') : Storage::disk('public')->url($this->image);
    }
}
