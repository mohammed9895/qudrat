<?php

namespace App\Livewire\Frontend\DigitalLibrary;

use App\Enums\Status;
use App\Models\DigitalLibraryCategory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Category extends Component
{
    public DigitalLibraryCategory $category;

    #[Url]
    public $search = '';

    public function mount(DigitalLibraryCategory $category)
    {
        $this->category = $category;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.digital-library.main-title'), route('digital-library.index'))
            ->push($this->category->name, route('digital-library.category', $this->category));
    }

    #[Computed]
    public function posts()
    {
        return $this->category->digitalLibraryposts()
            ->where('status', Status::Active)
            ->where('title', 'like', "%{$this->search}%")
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.frontend.digital-library.category');
    }
}
