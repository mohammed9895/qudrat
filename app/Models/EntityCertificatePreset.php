<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class EntityCertificatePreset extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name', 'description'];

    protected $casts = [
        'status' => Status::class,
    ];

    protected static function booted()
    {
        static::creating(function($model) {
            $model->created_by = auth()->id();
            $model->entity_id = auth()->user()->entity->id;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }
}
