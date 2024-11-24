<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'dob' => 'datetime',
        'categories' => 'array',
        'skills' => 'array',
        'languages' => 'array',
        'tools' => 'array',
        'interests' => 'array',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }
}
