<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    use HasTranslations;
    use SoftDeletes;

    public array $translatable = ['name'];

    protected $guarded = [];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
