<?php

namespace App\Livewire\Frontend\DigitalLibrary;

use App\Enums\Status;
use App\Models\DigitalLibraryCategory;
use App\Models\DigitalLibraryPost;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class ListPosts extends Component
{
    public $categoriesList = [];

    public $categories;

    #[Url]
    public $search = '';

    public function mount()
    {
        $this->categories = DigitalLibraryCategory::whereHas('DigitalLibraryPosts')->where('status', Status::Active)->get();
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.digital-library.main-title'), route('digital-library.index'));
    }

    #[Computed]
    public function posts()
    {
        $query = DigitalLibraryPost::query()
            ->where('status', Status::Active);

        if (! empty($this->categoriesList)) {
            $query->whereIn('digital_library_category_id', $this->categoriesList);
        }

        if (! empty($this->search)) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        $posts = $query->paginate(10);

        return $posts;
    }

    public function render()
    {
        return view('livewire.frontend.digital-library.list-posts');
    }
}
