<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Innovators extends Component
{
    public $category;

    public function mount()
    {
        $this->category = Category::where('slug', 'innovators')->first();
    }

    public function breadcrumbs(Trail $trail): Trail
    {
       return $trail
            ->push(__('general.social-window.oman-reasrchers'), route('social-window.index'))
            ->push($this->category->name);
    }

    public function render()
    {
        return view('livewire.frontend.innovators');
    }
}
