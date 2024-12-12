<?php

namespace App\Livewire\Frontend\SocialWindow;

use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Category extends Component
{
    public \App\Models\Category $category;
    public function mount(\App\Models\Category $category)
    {
        $this->category = $category;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Social Window', route('social-window.index'))
            ->push($this->category->name, route('social-window.category', $this->category));
    }

    public function render()
    {
        return view('livewire.frontend.social-window.category');
    }
}
