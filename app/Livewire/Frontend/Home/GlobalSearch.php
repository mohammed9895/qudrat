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

        // If a specific searchType is set → use match
        if (! empty($this->searchType)) {
            $this->results = match ($this->searchType) {
                'profiles' => Profile::with('category')
                    ->where('public_profile', true)
                    ->where(function ($q) use ($query) {
                        $q->whereTranslationLike('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%")
                            ->orWhereHas('category', fn ($cat) => $cat->whereTranslationLike('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'experts' => Profile::with('category')
                    ->where('is_expert', true)
                    ->where('public_profile', true)
                    ->where(function ($q) use ($query) {
                        $q->whereTranslationLike('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%")
                            ->orWhereHas('category', fn ($cat) => $cat->whereTranslationLike('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'jobs' => JobApplication::with(['jobDepartment', 'province', 'employmentType'])
                    ->where(function ($q) use ($query) {
                        $q->whereTranslationLike('title', 'like', "%{$query}%")
                            ->orWhere('position', 'like', "%{$query}%")
                            ->whereTranslationLike('description', 'like', "%{$query}%")
                            ->orWhereHas('jobDepartment', fn ($cat) => $cat->whereTranslationLike('name', 'like', "%{$query}%"))
                            ->orWhereHas('province', fn ($cat) => $cat->whereTranslationLike('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'works' => Work::with(['workCategory', 'profile'])
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhereHas('workCategory', fn ($cat) => $cat->where('name', 'like', "%{$query}%"))
                            ->orWhereHas('profile', fn ($p) => $p->where('fullname', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'researchers' => Profile::with('category')
                    ->whereHas('category', fn ($cat) => $cat->where('name', 'Researcher'))
                    ->where(function ($q) use ($query) {
                        $q->where('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%");
                    })
                    ->limit(5)->get(),

                'innovators' => Profile::with('category')
                    ->whereHas('category', fn ($cat) => $cat->where('name', 'Innovators'))
                    ->where(function ($q) use ($query) {
                        $q->where('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%");
                    })
                    ->limit(5)->get(),
                'default' => [],
            };
        } else {
            // No searchType selected — search all categories
            $this->results = [
                'profiles' => Profile::with('category')
                    ->where('public_profile', true)
                    ->where(function ($q) use ($query) {
                        $q->where('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%")
                            ->orWhereHas('category', fn ($cat) => $cat->where('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'experts' => Profile::with('category')
                    ->where('is_expert', true)
                    ->where('public_profile', true)
                    ->where(function ($q) use ($query) {
                        $q->where('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%")
                            ->orWhereHas('category', fn ($cat) => $cat->where('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'jobs' => JobApplication::with(['jobDepartment', 'province', 'employmentType'])
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                            ->orWhere('position', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhereHas('jobDepartment', fn ($cat) => $cat->where('name', 'like', "%{$query}%"))
                            ->orWhereHas('province', fn ($cat) => $cat->where('name', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'works' => Work::with(['workCategory', 'profile'])
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhereHas('workCategory', fn ($cat) => $cat->where('name', 'like', "%{$query}%"))
                            ->orWhereHas('profile', fn ($p) => $p->where('fullname', 'like', "%{$query}%"));
                    })
                    ->limit(5)->get(),

                'researchers' => Profile::with('category')
                    ->whereHas('category', fn ($cat) => $cat->where('name', 'Researcher'))
                    ->where(function ($q) use ($query) {
                        $q->where('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%");
                    })
                    ->limit(5)->get(),

                'innovators' => Profile::with('category')
                    ->whereHas('category', fn ($cat) => $cat->where('name', 'Innovators'))
                    ->where(function ($q) use ($query) {
                        $q->where('fullname', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%");
                    })
                    ->limit(5)->get(),
            ];
        }
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
