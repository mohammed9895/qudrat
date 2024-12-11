<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    protected $table = 'educations';

    protected $guarded = [];


    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
