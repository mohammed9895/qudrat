<?php

namespace App\Livewire\Frontend\DigitalLibrary;

use App\Models\DigitalLibraryCategory;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Category extends Component
{

    public DigitalLibraryCategory $category;

    public function mount(DigitalLibraryCategory $category)
    {
        $this->category = $category;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Digital Library', route('digital-library.index'))
            ->push($this->category->name, route('digital-library.category', $this->category));
    }

    public function render()
    {
        return view('livewire.frontend.digital-library.category');
    }
}
