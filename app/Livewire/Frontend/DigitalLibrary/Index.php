<?php

namespace App\Livewire\Frontend\DigitalLibrary;

use App\Enums\Status;
use App\Models\DigitalLibraryLink;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.digital-library.main-title'), route('digital-library.index'));
    }

    public function render()
    {
        $links = DigitalLibraryLink::where('status', Status::Active)->get();

        return view('livewire.frontend.digital-library.index', [
            'links' => $links,
        ]);
    }
}
