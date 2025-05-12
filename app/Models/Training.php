<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Training extends Model
{
    use HasTranslations;

    protected $fillable = [
        'profile_id',
        'course_name',
        'country',
        'type',
        'duration',
        'start_date',
        'end_date',
    ];

    public $translatable = ['course_name', 'country', 'type'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}