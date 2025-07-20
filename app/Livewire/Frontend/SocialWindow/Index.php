<?php

namespace App\Livewire\Frontend\SocialWindow;

use App\Enums\Status;
use App\Models\Category;
use App\Models\EducationType;
use App\Models\ExperienceLevel;
use App\Models\Profile;
use App\Models\Province;
use App\Models\State;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component implements HasForms
{
    use InteractsWithForms;
    use WithPagination;

    public array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('search')
                ->label(__('general.search'))
                ->placeholder(__('general.search-placeholder'))
                ->live(onBlur: true)
                ->columnSpanFull()
                ->required(),
            Select::make('province_id')
                ->label(__('general.basic-information.province'))
                ->required()
                ->options(Province::all()->pluck('name', 'id'))
                ->searchable()
                ->reactive()
                ->afterStateUpdated(fn (Set $set) => $set('state_id', null)),
            Select::make('state_id')
                ->label(__('general.basic-information.state'))
                ->required()
                ->options(function (Get $get) {
                    $province = Province::find($get('province_id'));
                    if (! $province) {
                        return State::all()->pluck('name', 'id');
                    }

                    return $province->states->pluck('name', 'id');
                })
                ->searchable(),
            Select::make('category')
                ->searchable()
                ->label(__('general.category'))
                ->options(function () {
                    return Category::whereHas('profiles')
                        ->where('status', Status::Active)
                        ->pluck('name', 'id');
                }),
            Select::make('gender')
                ->searchable()
                ->label(__('general.gender'))
                ->options([
                    0 => __('general.gender-types.male'),
                    1 => __('general.gender-types.female'),
                ]),
            Select::make('educationType')
                ->searchable()
                ->label(__('general.education-level'))
                ->options(EducationType::pluck('name', 'id')),
            Select::make('experienceLevel')
                ->searchable()
                ->label(__('general.experience-level'))
                ->options(ExperienceLevel::pluck('name', 'id')),
        ])->statePath('data');
    }

    #[Computed()]
    public function profiles()
    {
        return Profile::query()
            ->where('status', Status::Active)
            ->where('public_profile', true)
            ->when($this->data['search'], function ($query) {
                $query->where('fullname', 'like', "%{$this->data['search']}%");
            })
            ->when($this->data['province_id'], function ($query) {
                $query->where('province_id', $this->data['province_id']);
            })
            ->when($this->data['state_id'], function ($query) {
                $query->where('state_id', $this->data['state_id']);
            })
            ->when($this->data['gender'], function ($query) {
                $query->where('gender', $this->data['gender']);
            })
            ->when($this->data['category'], function ($query) {
                $query->whereHas('categories', function ($query) {
                    $query->where('category_id', $this->data['category']);
                });
            })
            ->when($this->data['educationType'], function ($query) {
                $query->where('education_type_id', $this->data['educationType']);
            })
            ->when($this->data['experienceLevel'], function ($query) {
                $query->where('experience_level_id', $this->data['experienceLevel']);
            })
            ->paginate(10);
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
