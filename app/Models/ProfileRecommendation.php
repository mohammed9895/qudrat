<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProfileRecommendation extends Model
{
    use HasTranslations;

    public $translatable = ['recommendation'];

    protected $fillable = [
        'profile_id',
        'section',
        'recommendation',
        'generated_at',
        'profile_last_updated_at',
    ];

    protected $casts = [
        'recommendation' => 'array',
        'generated_at' => 'datetime',
        'profile_last_updated_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
