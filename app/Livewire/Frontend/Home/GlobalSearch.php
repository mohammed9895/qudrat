<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Profile;

class GlobalSearch extends Component
{
    #[Url] 
    public $search = '';

    public $results = [];

    public function search()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];
            return;
        }

        $this->results = [
            'profiles' => Profile::with('category')
                ->where('public_profile', true)
                    ->where(function ($q) {
                        $q->where('fullname', 'like', '%' . $this->query . '%')
                    ->orWhere('username', 'like', '%' . $this->query . '%')
                    ->orWhereHas('category', fn($query) => $query->where('name', 'like', '%' . $this->query . '%'));
                        })
                        ->limit(5)
                        ->get(),
            'experts' => Profile::with('category')
                    ->where('is_expert', true)
                    ->where('public_profile', true)
                    ->where(function ($q) {
                                $q->where('fullname', 'like', '%' . $this->query . '%')
                                ->orWhere('username', 'like', '%' . $this->query . '%')
                                ->orWhereHas('category', fn($query) => $query->where('name', 'like', '%' . $this->query . '%'));
                        })
                    ->limit(5)
                    ->get(),
            'jobs' => JobApplication::with(['jobDepartment', 'province', 'employmentType'])
            ->where(function ($q) {
                $q->where('title', 'like', '%' . $this->query . '%')
                  ->orWhere('position', 'like', '%' . $this->query . '%')
                  ->orWhere('description', 'like', '%' . $this->query . '%')
                  ->orWhereHas('jobDepartment', fn($q) => $q->where('name', 'like', '%' . $this->query . '%'))
                  ->orWhereHas('province', fn($q) => $q->where('name', 'like', '%' . $this->query . '%'));
            })
            ->limit(5)
            ->get(),
            'works' => Work::with(['workCategory', 'profile'])
                ->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->query . '%')
                    ->orWhere('description', 'like', '%' . $this->query . '%')
                    ->orWhereHas('workCategory', fn($q) => $q->where('name', 'like', '%' . $this->query . '%'))
                    ->orWhereHas('profile', fn($q) => $q->where('fullname', 'like', '%' . $this->query . '%'));
                })
                ->limit(5)
                ->get(),
                'researchers' => Profile::with('category')
                    ->whereHas('category', fn($q) => $q->where('name', 'Researcher'))
                    ->where(function ($q) {
                        $q->where('fullname', 'like', '%' . $this->query . '%')
                        ->orWhere('username', 'like', '%' . $this->query . '%')
                        ->orWhereHas('category', fn($q) => $q->where('name', 'like', '%' . $this->query . '%'));
                    })
                    ->limit(5)
                    ->get(),
                    'innovators' => Profile::with('category')
                    ->whereHas('category', fn($q) => $q->where('name', 'Innovators'))
                    ->where(function ($q) {
                        $q->where('fullname', 'like', '%' . $this->query . '%')
                        ->orWhere('username', 'like', '%' . $this->query . '%')
                        ->orWhereHas('category', fn($q) => $q->where('name', 'like', '%' . $this->query . '%'));
                    })
                    ->limit(5)
                    ->get(),
        ];
    }

    public function render()
    {
        return view('livewire.frontend.home.global-search');
    }
}
