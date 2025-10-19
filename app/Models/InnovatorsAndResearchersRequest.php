<?php

namespace App\Models;

use App\Enums\ExpertRequestStatus;
use Illuminate\Database\Eloquent\Model;

class InnovatorsAndResearchersRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'attachments' => 'array', // Assuming attachments are stored as JSON
        'status' => ExpertRequestStatus::class, // Status can be an integer representing different states
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
