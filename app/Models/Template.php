<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Template extends Model
{
    use HasTranslations;

    use HasFactory;

    public array $translatable = ['name', 'description'];

    protected $guarded = [];
}
