<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $registrationData;

    public $fallbackData;

    public function __construct(User $user, $registrationData = null, $fallbackData = null)
    {
        $this->user = $user;
        $this->registrationData = $registrationData;
        $this->fallbackData = $fallbackData;
    }
}
