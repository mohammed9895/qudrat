<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public $translatable = ['name'];
}
