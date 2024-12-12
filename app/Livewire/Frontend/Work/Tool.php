<?php

namespace App\Livewire\Frontend\Work;

use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Tool extends Component
{
    public \App\Models\Tool $tool;

    public function mount(\App\Models\Tool $tool)
    {
        $this->tool = $tool;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Works', route('works.index'))
            ->push('Tools', route('works.index'))
            ->push($this->tool->name, route('works.tool', $this->tool));
    }

    public function render()
    {
        return view('livewire.frontend.work.tool');
    }
}
