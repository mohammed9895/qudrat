<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class DigitalLibraryLink extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'cover'];

    protected $guarded = [];

    public function getThumbnailImage()
    {
        return !$this->cover ? asset('assets/images/unset.jpg') : Storage::disk('public')->url($this->cover);
    }
}
