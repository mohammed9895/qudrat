<?php

namespace App\Models;

use App\Enums\ExpertRequestStatus;
use Illuminate\Database\Eloquent\Model;

class ExpertRequest extends Model
{
    protected $fillable = [
        'profile_id',
        'reason',
        'attachments',
        'message',
        'status',
    ];

    protected $casts = [
        'attachments' => 'array', // Assuming attachments are stored as JSON
        'status' => ExpertRequestStatus::class, // Status can be an integer representing different states
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
