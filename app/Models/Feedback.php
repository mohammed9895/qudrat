<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Rating;
use App\Enums\Users;

class Feedback extends Model
{
    
    protected $guarded = [];

    protected $table = 'feedbacks';

    protected $casts = [
        'user_type'=> Users::class,
        'general_impression' => Rating::class, 
        'ease' => Rating::class, 
        'speed'=> Rating::class,
        'meet_your_needs'=> Rating::class,
        'clarity' => Rating::class
    ];
}
