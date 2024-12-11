<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name'];

    protected $casts = [
        'status' => Status::class,
    ];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }

    public function profilesCategories(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }
}
