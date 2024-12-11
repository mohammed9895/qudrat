<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class School extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name', 'description', 'address'];

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }
}
