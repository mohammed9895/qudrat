<?php

namespace App\Livewire\Frontend\Work;

use App\Models\Work;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Show extends Component
{
    public Work $work;

    public function mount(Work $work)
    {
        $this->work = $work;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Works', route('works.index'))
            ->push($this->work->title, route('works.show', $this->work));
    }

    #[On('download-attachment')]
    public function downloadAttachment($attachment)
    {
        dd($attachment);
        return response()->download(storage_path($attachment));
    }

    public function render()
    {
        return view('livewire.frontend.work.show');
    }
}
