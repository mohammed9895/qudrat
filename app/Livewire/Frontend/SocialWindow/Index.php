<?php

namespace App\Livewire\Frontend\SocialWindow;

use App\Enums\Status;
use App\Models\Category;
use App\Models\EducationType;
use App\Models\ExperienceLevel;
use App\Models\Profile;
use App\Models\Province;
use App\Models\State;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    #[Url]
    public $search = '';

    public  $province = 1;

    public  $state;

    public $category;

    public $gender;

    public $educationType;

    public $experienceLevel;

    public function mount()
    {
    }

    #[Computed()]
    public function profiles()
    {
        return Profile::query()
            ->where('status', Status::Active)
            ->where('public_profile', true)
            ->where('fullname', 'like', "%{$this->search}%")
            ->when($this->province, function ($query) {
                $query->where('province_id', $this->province);
            })
            ->when($this->state, function ($query) {
                $query->where('state_id', $this->state);
            })
            ->when($this->gender, function ($query) {
                $query->where('gender', $this->gender);
            })
            ->when($this->category, function ($query) {
                $query->whereHas('categories', function ($query) {
                    $query->where('category_id', $this->category);
                });
            })
            ->when($this->educationType, function ($query) {
                $query->where('education_type_id', $this->educationType);
            })
            ->when($this->experienceLevel, function ($query) {
                $query->where('experience_level_id', $this->experienceLevel);
            })
            ->paginate(10);
    }

    #[Computed()]
    public function states()
    {
        return State::where('province_id', $this->province)
            ->get();
    }
    public function render()
    {
        $provinces = Province::all();

        return view('livewire.frontend.social-window.index', [
            'provinces' => $provinces,
            'categories' => Category::whereHas('profiles')->where('status', Status::Active)->get(),
            'experiences_levels' => ExperienceLevel::all(),
            'educationTypes' => EducationType::all(),
        ]);
    }
}
