<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ExperienceLevel extends Model
{
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name'];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
