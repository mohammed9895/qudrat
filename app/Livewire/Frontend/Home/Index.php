<?php

namespace App\Livewire\Frontend\Home;

use App\Enums\Status;
use App\Models\Profile;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $talents = Profile::where('is_active', Status::Active)
            ->latest()
            ->limit(6)
            ->get();
        return view('livewire.frontend.home.index', [
            'talents' => $talents,
        ]);
    }
}
