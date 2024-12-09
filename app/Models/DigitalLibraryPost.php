<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DigitalLibraryPost extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'description', 'image'];

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
        return $this->belongsTo(DigitalLibraryCategory::class);
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
        $isUrl = str_contains($this->image, 'http');
        return $isUrl ? $this->image : \Storage::disk('public')->url($this->image);
    }
}
