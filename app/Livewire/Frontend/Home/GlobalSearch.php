<?php

namespace App\Livewire\Frontend\Home;

use App\Models\JobApplication;
use App\Models\Profile;
use App\Models\Work;
use Livewire\Attributes\Url;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class GlobalSearch extends Component
{
    #[Url]
    public $search = '';

    #[Url]
    public $searchType = null;

    public $results = [];

    public function mount()
    {
        $this->search();
    }

    public function search()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];

            return;
        }

        $query = $this->search;

        $locale = app()->getLocale();

        $this->results = [
                'profiles' => Profile::with('category')
                    ->where('public_profile', true)
                    ->where(function ($q) use ($query, $locale) {
                        $q->where("fullname->ar", 'like', "%{$query}%")
                            ->orWhere('title', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%")
                            ->orWhereHas('category', fn ($cat) => $cat->where('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'experts' => Profile::with('category')
                    ->where('is_expert', true)
                    ->where('public_profile', true)
                    ->where(function ($q) use ($query) {
                        $q->where('fullname->en', 'like', "%{$query}%")
                            ->orWhere('fullname->ar', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%")
                            ->orWhereHas('category', fn ($cat) => $cat->where('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'jobs' => JobApplication::with(['jobDepartment', 'province', 'employmentType'])
                    ->where(function ($q) use ($query) {
                        $q->where('title->en', 'like', "%{$query}%")
                            ->orWhere('title->ar', 'like', "%{$query}%")
                            ->orWhere('position', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhereHas('jobDepartment', fn ($cat) => $cat->where('name->ar', "%{$query}%")->orWhere('name->ar', "%{$query}%"))
                            ->orWhereHas('province', fn ($cat) => $cat->where('name->ar', "%{$query}%")->orWhere('name->ar', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'works' => Work::with(['workCategory', 'profile'])
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhereHas('workCategory', fn ($cat) => $cat->where('name->ar', "%{$query}%")->orWhere('name->ar', "%{$query}%"))
                            ->orWhereHas('profile', fn ($p) => $p->where('name->ar', "%{$query}%")->orWhere('name->ar', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'researchers' => Profile::with('category')
                    ->whereHas('category', fn ($cat) => $cat->where('name', 'Researcher'))
                    ->where(function ($q) use ($query) {
                        $q->where('fullname->en', 'like', "%{$query}%")
                            ->orWhere('fullname->ar', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%");
                    })
                    ->limit(5)->get(),

                'innovators' => Profile::with('category')
                    ->whereHas('category', fn ($cat) => $cat->where('name', 'Innovators'))
                    ->where(function ($q) use ($query) {
                        $q->where('fullname->en', 'like', "%{$query}%")
                            ->orWhere('fullname->ar', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%");
                    })
                    ->limit(5)->get(),
            ];
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.search-result'), route('search'));
    }

    public function render()
    {
        return view('livewire.frontend.home.global-search');
    }
}
