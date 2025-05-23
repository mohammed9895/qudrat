<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Language extends Model
{
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name'];

    public function profile(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }
}
