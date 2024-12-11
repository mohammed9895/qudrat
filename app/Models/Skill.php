<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Skill extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'status' => Status::class,
    ];

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }

    public function works(): BelongsToMany
    {
        return $this->belongsToMany(Work::class);
    }
}
