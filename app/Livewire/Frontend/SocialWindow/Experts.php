<?php

namespace App\Livewire\Frontend\SocialWindow;

use App\Models\Profile;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Experts extends Component
{

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Social Window', route('social-window.index'))
            ->push('Experts', route('social-window.experts'));
    }


    public function render()
    {
        return view('livewire.frontend.social-window.experts',
        [
            'profiles' => Profile::where('is_expert', 1)->paginate(10),
        ]);
    }
}
