<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $guarded = [];


    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
