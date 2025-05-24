<?php

namespace App\Jobs;

use App\Models\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchRecommendationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public Profile $profile;

    /**
     * Create a new job instance.
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sections = ['educations', 'skills', 'experiences'];

        foreach ($sections as $section) {
            $this->profile->getSectionRecommendation($section);
        }
    }
}
