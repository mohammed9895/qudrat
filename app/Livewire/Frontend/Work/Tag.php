<?php

namespace App\Livewire\Frontend\Work;

use App\Models\WorkCategory;
use App\Models\WorkTag;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Tag extends Component
{

    public WorkTag $tag;

    public function mount(WorkTag $tag)
    {
        $this->tag = $tag;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Works', route('works.index'))
            ->push('Tags', route('works.index'))
            ->push($this->tag->name, route('works.tag', $this->tag));
    }


    public function render()
    {
        return view('livewire.frontend.work.tag');
    }
}
