<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class InternationalTalents extends Component
{
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.international-talent.title'), route('international-talents.index'));
    }

    public function render()
    {
        return view('livewire.frontend.international-talents');
    }
}
