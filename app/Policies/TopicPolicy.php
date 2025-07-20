<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;

class TopicPolicy
{
    public function view(User $user, Topic $topic): bool
    {
        if ($topic->creator_id === $user->id || $topic->receiver_id === $user->id) {
            return true;
        }

        return false;
    }
}
