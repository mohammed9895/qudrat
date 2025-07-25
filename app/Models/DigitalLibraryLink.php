<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class DigitalLibraryLink extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $guarded = [];

    public function getThumbnailImage()
    {
        return ! $this->cover ? asset('assets/images/unset.jpg') : Storage::disk('nfs')->url($this->cover);
    }
}
