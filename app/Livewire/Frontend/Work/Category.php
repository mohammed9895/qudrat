<?php

namespace App\Livewire\Frontend\Work;

use App\Models\WorkCategory;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Category extends Component
{
    public WorkCategory $category;

    public function mount(WorkCategory $category)
    {
        $this->category = $category;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Works', route('works.index'))
            ->push('Categories', route('works.index'))
            ->push($this->category->name, route('works.category', $this->category));
    }

    public function render()
    {
        return view('livewire.frontend.work.category');
    }
}
