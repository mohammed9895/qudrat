<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Interest extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name'];

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }
}
