<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalLibraryTag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function posts()
    {
        return $this->belongsToMany(DigitalLibraryPost::class, 'digital_library_post_tags');
    }

}
