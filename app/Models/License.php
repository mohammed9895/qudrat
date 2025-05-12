<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class License extends Model
{
    use HasTranslations;

    protected $fillable = [
        'type', 'issue_date', 'expire_date', 'issue_place', 'profile_id'
    ];

    public $translatable = ['type', 'issue_place'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}