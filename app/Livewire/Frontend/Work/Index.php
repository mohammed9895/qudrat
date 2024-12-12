<?php

namespace App\Livewire\Frontend\Work;

use App\Enums\Status;
use App\Models\Work;
use Livewire\Attributes\Computed;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    #[Computed()]
    public function works()
    {
        return Work::where('status', Status::Active)->paginate(12);
    }
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Works', route('works.index'));
    }
    public function render()
    {
        return view('livewire.frontend.work.index');
    }
}
