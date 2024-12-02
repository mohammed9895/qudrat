<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DigitalLibraryPost extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'description'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function digitalLibraryCategory()
    {
        return $this->belongsTo(DigitalLibraryCategory::class);
    }
}
