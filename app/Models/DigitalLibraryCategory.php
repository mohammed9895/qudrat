<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DigitalLibraryCategory extends Model
{

    use HasFactory;
    use HasTranslations;
    protected $fillable = ['name', 'slug', 'description', 'image', 'parent_id'];

    public $translatable = ['name', 'description', 'image'];

    public function children()
    {
        return $this->hasMany(DigitalLibraryCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(DigitalLibraryCategory::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(DigitalLibraryPost::class);
    }
}
