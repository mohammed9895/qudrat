<?php

namespace App\Livewire\Frontend\Work;

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
            ->push(__('general.works'), route('works.index'))
            ->push(__('general.tags'), route('works.index'))
            ->push($this->tag->name, route('works.tag', $this->tag));
    }

    public function render()
    {
        return view('livewire.frontend.work.tag');
    }
}
