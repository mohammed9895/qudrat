<?php

namespace App\Livewire\Frontend\Profile;

use App\Models\Profile;
use Filament\Notifications\Notification;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    public Profile $profile;

    public $rating;
    public $comment = null;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;

        if ($profile->public_profile == false) {
            abort(403, 'This profile is not public.');
        }
    }
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Social Window', route('social-window.index'))
            ->push($this->profile->user->name, route('profile.index', $this->profile));
    }

    public function rate()
    {
        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $this->profile->ratings()->updateOrCreate([
            'user_id' => auth()->id(),
            'profile_id' => $this->profile->id,
        ],[
            'rating' => $this->rating,
            'comment' => $this->comment,
            'status' => 1,
        ]);

        Notification::make()
            ->title('Rating Submitted')
            ->body('Thank you for rating this profile.')
            ->send();
    }

    public function render()
    {
        views($this->profile)->cooldown(now()->addMinute(10))->record();
        return view('livewire.frontend.profile.index');
    }
}
