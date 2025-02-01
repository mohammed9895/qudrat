<?php

namespace App\Livewire\Frontend\DigitalLibrary;

use App\Enums\Status;
use App\Models\DigitalLibraryCategory;
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
        $categories = DigitalLibraryCategory::where('status', Status::Active)->whereHas('posts')->withCount('posts')->get();

        return view('livewire.frontend.digital-library.index', [
            'categories' => $categories,
        ]);
    }
}
