<?php

namespace App\Livewire\Frontend\Work;

use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Skill extends Component
{
    public \App\Models\Skill $skill;

    public function mount(\App\Models\Skill $skill)
    {
        $this->skill = $skill;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.works'), route('works.index'))
            ->push(__('general.skills'), route('works.index'))
            ->push($this->skill->name, route('works.skill', $this->skill));
    }

    public function render()
    {
        return view('livewire.frontend.work.skill');
    }
}
