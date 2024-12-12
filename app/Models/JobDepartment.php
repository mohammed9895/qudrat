<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class JobDepartment extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    public array $translatable = ['name', 'description'];

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
