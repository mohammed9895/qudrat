<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class EntityCertificatePreset extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded = [];

    public array $translatable = ['name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
