<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function($model) {
            $model->addable_type = User::class;
            $model->addable_id = auth()->id() ?? null;
        });
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
