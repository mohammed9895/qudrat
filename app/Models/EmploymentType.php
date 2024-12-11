<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Translatable\HasTranslations;

class EmploymentType extends Model
{
    use HasTranslations;
    use SoftDeletes;

    protected $table = 'employee_types';

    protected $guarded = [];

    public array $translatable = ['name'];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
