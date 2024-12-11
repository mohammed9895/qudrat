<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class WorkCategory extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public $translatable = ['name'];

    protected $casts = [
        'status' => Status::class,
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(WorkCategory::class, 'parent_id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }
}
