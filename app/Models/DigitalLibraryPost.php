<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Storage;

class DigitalLibraryPost extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['title', 'description'];

    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => Status::class,
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function digitalLibraryCategory()
    {
        return $this->belongsTo(DigitalLibraryCategory::class)->withCount('digitalLibraryPosts');
    }

    public function tags()
    {
        return $this->belongsToMany(DigitalLibraryTag::class, 'digital_library_post_tags');
    }

    public function comments()
    {
        return $this->hasMany(DigitalLibraryPostComment::class);
    }

    public function getThumbnailImage()
    {
        return !$this->cover ? asset('assets/images/unset.jpg') : Storage::disk('public')->url($this->cover);
    }
}
