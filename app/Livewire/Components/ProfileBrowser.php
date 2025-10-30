<?php

namespace App\Livewire\Components;

use App\Enums\EmployerCategory;
use App\Enums\Status;
use App\Models\Category;
use App\Models\Country;
use App\Models\EducationType;
use App\Models\Employer;
use App\Models\ExperienceLevel;
use App\Models\Profile;
use App\Models\Province;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class ProfileBrowser extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use WithPagination;

    public array $data = [];

    public int $perPage = 9;

    public bool $onlyPublic = true;

    public bool $filterByStatus = true;

    public bool $onlyExperts = false;

    public ?int $categoryId = null;

    public bool $internationalTalents = false;

    public $viewMode = 'grid';

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('search')
                ->label(__('general.search'))
                ->placeholder(__('general.search-placeholder'))
                ->live(onBlur: true)
                ->columnSpanFull(),

            Select::make('province_id')
                ->hidden($this->internationalTalents) // hide if passed
                ->label(__('general.basic-information.province'))
                ->options(Province::pluck('name', 'id'))
                ->searchable()
                ->reactive()
                ->live()
                ->afterStateUpdated(fn ($set) => $set('state_id', null)),

            Select::make('state_id')
                ->live()
                ->hidden($this->internationalTalents) // hide if passed
                ->label(__('general.basic-information.state'))
                ->options(fn ($get) => Province::find($get('province_id'))?->states->pluck('name', 'id') ?? State::pluck('name', 'id'))
                ->searchable(),

            Select::make('category')
                ->label(__('general.category'))
                ->visible(is_null($this->categoryId)) // hide if passed
                ->options(Category::whereHas('profiles')->pluck('name', 'id'))
                ->searchable(),

            Select::make('employer_category')
                ->label(__('general.basic-information.employer'))
                ->options(collect(EmployerCategory::cases())->mapWithKeys(
                    fn ($c) => [$c->value => $c->getLabel()]
                ))
                ->searchable()
                ->native(false)
                ->reactive()
                ->live()
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    // Always clear employer when category changes
                    $set('employer', null);

                    // Reset pagination so you see the new results
                    try {
                        $this->resetPage();
                    } catch (Throwable $e) {
                    }
                }),

            // Employer (ID) – only for categories that require it
            Select::make('employer')
                ->label(__('general.basic-information.employer_name'))
                ->options(function (Get $get) {
                    $category = $get('employer_category');

                    // No employer list for Job Seekers / Entrepreneurship
                    if (! $category || in_array($category, [
                        EmployerCategory::JobSeekers->value,
                        EmployerCategory::Entrepreneurship->value,
                    ])) {
                        return [];
                    }

                    return Employer::query()
                        ->where('category', $category)
                        ->where('is_active', true)
                        ->orderBy('sort')
                        ->get()
                        ->mapWithKeys(fn ($e) => [
                            $e->id => $e->getTranslation('name', app()->getLocale()),
                        ]);
                })
                ->visible(fn (Get $get) => ! in_array(
                    $get('employer_category'),
                    [EmployerCategory::JobSeekers->value, EmployerCategory::Entrepreneurship->value]
                ))
                ->searchable()
                ->native(false)
                ->reactive()
                ->getOptionLabelUsing(fn ($value) => Employer::find($value)?->getTranslation('name', app()->getLocale())
                )
                ->afterStateUpdated(function () {
                    try {
                        $this->resetPage();
                    } catch (Throwable $e) {
                    }
                }),

            Select::make('country_id')
                ->label(__('general.country'))
                ->options(Country::pluck('name', 'id'))
                ->searchable()
                ->reactive()
                ->live(),

            Select::make('gender')
                ->label(__('general.gender'))
                ->options([
                    '1' => __('general.gender-types.male'),
                    '0' => __('general.gender-types.female'),
                ])
                ->live()
                ->searchable(),

            Select::make('educationType')
                ->live()
                ->label(__('general.education-level'))
                ->options(EducationType::pluck('name', 'id'))
                ->searchable(),

            Select::make('experienceLevel')
                ->live()
                ->label(__('general.experience-level'))
                ->options(ExperienceLevel::pluck('name', 'id'))
                ->searchable(),

        ])->statePath('data');
    }

    #[Computed()]
    public function profiles()
    {
        return Profile::query()
            ->with('skills') // Eager load
            ->when($this->filterByStatus, fn ($q) => $q->where('status', Status::Active))
            ->when($this->onlyPublic, fn ($q) => $q->where('public_profile', true))
            ->when($this->onlyExperts, fn ($q) => $q->where('is_expert', true))
            ->when($this->internationalTalents, fn ($q) => $q->where('international_profile', true))
            ->when($this->data['search'] ?? null, fn ($q, $v) => $q->where('fullname', 'like', "%{$v}%"))
            ->when($this->data['province_id'] ?? null, fn ($q, $v) => $q->where('province_id', $v))
            ->when($this->data['state_id'] ?? null, fn ($q, $v) => $q->where('state_id', $v))
            ->when($this->data['country_id'] ?? null, fn ($q, $v) => $q->where('country_id', $v))
            ->when(isset($this->data['gender']), fn ($q) => $q->where('gender', $this->data['gender']))
            ->when($this->data['educationType'] ?? null, fn ($q, $v) => $q->where('education_type_id', $v))
            ->when($this->data['experienceLevel'] ?? null, fn ($q, $v) => $q->where('experience_level_id', $v))
            ->when($this->categoryId, function ($query) {
                $query->whereHas('categories', fn ($q) => $q->where('category_id', $this->categoryId));
            }, function ($query) {
                $query->when($this->data['category'] ?? null, fn ($q, $val) => $q->whereHas('categories', fn ($q2) => $q2->where('category_id', $val))
                );
            })
            ->when($this->data['employer_category'] ?? null, function ($q, $cat) {
                // Always constrain by employer_category first
                $q->where('employer_category', $cat);

                // If Job Seekers or Entrepreneurship, ignore employer completely
                if (in_array($cat, [
                    EmployerCategory::JobSeekers->value,
                    EmployerCategory::Entrepreneurship->value,
                ])) {
                    // Do NOT apply any condition on employer
                    return;
                }

                // For all other categories, also filter by employer if selected
                if (! empty($this->data['employer'])) {
                    $q->where('employer', $this->data['employer']);
                }
            })
// Fallback: if employer selected but no category chosen, still filter by employer
            ->when(($this->data['employer'] ?? null) && empty($this->data['employer_category']), function ($q) {
                $q->where('employer', $this->data['employer']);
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.components.profile-browser');
    }
}
