<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalLibraryTag extends Model
{
    /** @use HasFactory<\Database\Factories\DigitalLibraryTagFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function posts()
    {
        return $this->belongsToMany(DigitalLibraryPost::class, 'digital_library_post_tags');
    }

}
