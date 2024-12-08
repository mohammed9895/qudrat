<?php

namespace App\Livewire\Frontend\Profile;

use App\Models\Profile;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    public Profile $profile;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
    }
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Social Window', route('social-window.index'))
            ->push($this->profile->user->name, route('profile.index', $this->profile));
    }

    public function render()
    {
        return view('livewire.frontend.profile.index');
    }
}
