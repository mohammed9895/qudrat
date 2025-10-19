<?php

namespace App\Livewire\Frontend\Jobs;

use App\Models\RecruitmentPlatform;
use Filament\Panel\Concerns\HasBreadcrumbs;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    use HasBreadcrumbs, WithPagination;

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.jobs'), route('jobs.index'));
    }

    public function render()
    {
        return view('livewire.frontend.jobs.index', [
            'jobs' => RecruitmentPlatform::all(),
        ]);
    }
}
