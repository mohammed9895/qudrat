<?php

namespace App\Listeners;

use App\Jobs\FetchRecommendationsJob;
use Illuminate\Auth\Events\Login;

class DispatchRecommendationJob
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $profile = $event->user->profile;

        if ($profile) {
            FetchRecommendationsJob::dispatch($profile);
        }
    }
}
