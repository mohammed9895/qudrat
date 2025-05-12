<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldOfStudy extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name', 'description'];

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function parent()
    {
        return $this->belongsTo(FieldOfStudy::class, 'field_of_study_child_id');
    }

    // Relationship to get the child fields of study
    public function children()
    {
        return $this->hasMany(FieldOfStudy::class, 'field_of_study_child_id');
    }
}
