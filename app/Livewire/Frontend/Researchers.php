<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Researchers extends Component
{
    public $category;

    public function mount()
    {
        $this->category = Category::where('slug', 'researchers')->first();
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.navigation.social-window'), route('works.index'))
            ->push($this->category->name);
    }

    public function render()
    {
        return view('livewire.frontend.researchers');
    }
}
