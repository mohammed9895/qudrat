<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public $translatable = ['name'];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }

}
