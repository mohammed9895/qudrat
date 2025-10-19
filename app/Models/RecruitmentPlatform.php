<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class RecruitmentPlatform extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $guarded = [];

    public function getThumbnailImage()
    {
        return ! $this->logo ? asset('assets/images/unset.jpg') : Storage::disk('nfs')->url($this->logo);
    }
}
