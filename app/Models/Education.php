<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;

    protected $table = 'educations';

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->addable_type = User::class;
            $model->addable_id = auth()->id() ?? null;
        });
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function educationType(): BelongsTo
    {
        return $this->belongsTo(EducationType::class);
    }

    public function fieldOfStudy()
    {
        return $this->belongsTo(FieldOfStudy::class);
    }

    // Relationship to the child field of study
    public function fieldOfStudyChild()
    {
        return $this->belongsTo(FieldOfStudy::class, 'field_of_study_child_id');
    }
}
