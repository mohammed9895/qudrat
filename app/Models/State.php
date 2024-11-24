<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $guarded = [];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
