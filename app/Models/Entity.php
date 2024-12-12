<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function($model) {
            $model->user_id = auth()->id();
        });
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'entity_id');
    }

    public function entityCertificatePresets(): HasMany
    {
        return $this->hasMany(EntityCertificatePreset::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
