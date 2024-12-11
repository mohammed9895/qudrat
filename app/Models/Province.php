<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Province extends Model
{
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public $translatable = ['name'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
