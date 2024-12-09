<?php

namespace App\Livewire\Frontend\SocialWindow;

use App\Enums\Status;
use App\Models\Profile;
use App\Models\Province;
use App\Models\State;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{

    #[Url]
    public $search = '';

    public Province $province;

    public State $state;

    public function mount()
    {
        $this->province = Province::first();
    }

    #[Computed()]
    public function profiles()
    {
        return Profile::query()
            ->where('is_active', Status::Active)
            ->where('public_profile', true)
            ->where('fullname', 'like', "%{$this->search}%")
            ->get();
    }

    #[Computed()]
    public function states()
    {
        return $this->province->states;
    }
    public function render()
    {
        $provinces = Province::all();

        return view('livewire.frontend.social-window.index', [
            'provinces' => $provinces
        ]);
    }
}
