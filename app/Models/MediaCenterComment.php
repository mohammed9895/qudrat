<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaCenterComment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'media_center_post_id',
        'user_id',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(MediaCenterPost::class, 'media_center_post_id');
    }
}
