<?php

namespace App\Livewire\Frontend\Jobs;

use App\Enums\Status;
use App\Models\ExperienceLevel;
use App\Models\JobApplication;
use App\Models\JobDepartment;
use App\Models\Province;
use Filament\Panel\Concerns\HasBreadcrumbs;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    use HasBreadcrumbs, WithPagination;

    public array $departments;

    public array $provinces;

    public array $experiences = [];

    #[Url]
    public $search = '';

    public $province;

    public $experience;

    public $department;

    public function mount()
    {
        $this->departments = JobDepartment::where('status', Status::Active)->pluck('id')->toArray();
        $this->provinces = Province::pluck('id')->toArray();
        $this->experiences = ExperienceLevel::pluck('id')->toArray();
        $this->province = '';
        $this->experience = '';
        $this->department = '';
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.jobs'), route('jobs.index'));
    }

    #[Computed()]
    public function jobs()
    {
        return JobApplication::whereIn('job_department_id', $this->departments)
            ->where('title', 'like', '%'.$this->search.'%')
//            ->where('province_id', $this->province)
//            ->where('experience_level_id', $this->experience)
//            ->where('job_department_id', $this->department)
            ->whereIn('province_id', $this->provinces)
            ->whereIN('experience_level_id', $this->experiences)
            ->where('status', Status::Active)->paginate(10);
    }

    public function render()
    {
        return view('livewire.frontend.jobs.index', [
            'departments_list' => JobDepartment::where('status', Status::Active)->whereHas('jobApplications')->withCount('jobApplications')->get(),
            'provinces_list' => Province::whereHas('jobApplications')->withCount('jobApplications')->get(),
            'experiences_list' => ExperienceLevel::whereHas('jobApplications')->withCount('jobApplications')->get(),
        ]);
    }
}
