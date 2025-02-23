<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Storage;

class DigitalLibraryCategory extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['name', 'description', 'image'];

    protected $fillable = ['name', 'slug', 'description', 'image', 'parent_id'];

    public function children()
    {
        return $this->hasMany(DigitalLibraryCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(DigitalLibraryCategory::class, 'parent_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(DigitalLibraryPost::class);
    }

    public function getThumbnailImage()
    {
        $isUrl = str_contains($this->image, 'http');

        return $isUrl ? asset('assets/images/unset.jpg') : Storage::disk('public')->url($this->image);
    }
}
