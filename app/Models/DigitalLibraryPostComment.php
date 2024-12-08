<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalLibraryPostComment extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'digital_library_post_id',
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

    public function digitalLibraryPost()
    {
        return $this->belongsTo(DigitalLibraryPost::class, 'digital_library_post_id');
    }

}
