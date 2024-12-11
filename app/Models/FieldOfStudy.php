<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldOfStudy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name', 'description'];

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(FieldOfStudy::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(FieldOfStudy::class, 'parent_id');
    }
}
