<?php

namespace App\Livewire\Frontend\Home;

use App\Enums\Status;
use App\Models\Profile;
use Livewire\Component;

class Profiles extends Component
{
    public $title;

    public $title_description;

    public $profiles_per_category;

    public function mount($title, $description, $profiles_per_category)
    {
        $this->title = $title;
        $this->title_description = $description;
        $this->profiles_per_category = $profiles_per_category;
    }

    public function render()
    {
        $talents = Profile::where('status', Status::Active)
            ->where('public_profile', true)
            ->latest()
            ->limit(6)
            ->get();

        return view('livewire.frontend.home.profiles', [
            'talents' => $talents,
        ]);
    }
}
