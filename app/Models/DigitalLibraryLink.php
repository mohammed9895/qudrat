<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;

class DigitalLibraryLink extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'cover'];

    protected $guarded = [];

    public function getThumbnailImage()
    {
        // Get the current application locale (e.g., 'en' or 'ar')
        $lang = App::getLocale();

        // Check if the cover array has the language key and return the respective cover image URL
        $coverKey = $this->cover[$lang] ?? null;

        // If a cover image exists for the language, return its URL, else fallback to the default
        return $coverKey ? Storage::disk('public')->url($coverKey) : asset('assets/images/unset.jpg');
    }
}
