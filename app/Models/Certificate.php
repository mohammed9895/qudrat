<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'certificate_file' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function($model) {
            $model->addable_type = User::class;
            $model->addable_id = auth()->id() ?? null;
        });
    }

    public function addable(): MorphTo
    {
        return $this->morphTo();
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
