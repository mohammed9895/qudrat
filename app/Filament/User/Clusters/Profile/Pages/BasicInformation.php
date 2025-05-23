<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use App\Models\Country;
use App\Models\Profile as ProfileModel;
use App\Models\Province;
use App\Models\State;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class BasicInformation extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-user-account';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.user.clusters.profile.pages.basic-information';

    protected static ?string $cluster = Profile::class;

    public \App\Models\Profile $profile;

    public static function getNavigationLabel(): string
    {
        return __('general.basic-information.title');
    }

    public function getTitle(): string|Htmlable
    {
        return __('general.basic-information.title');
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->profile = \App\Models\Profile::where('user_id', auth()->id())->first();
        $this->form->fill($this->profile->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.basic-information.title'))
                    ->collapsible()
                    ->schema([
                        FileUpload::make('avatar')->avatar()->label(__('general.basic-information.avatar')),
                        TextInput::make('position')->label(__('general.basic-information.position')),
                        Select::make('experience_level_id')
                            ->preload()
                            ->label(__('general.basic-information.experience_level'))
                            ->searchable()
                            ->relationship('experienceLevel', 'name'),
                        RichEditor::make('bio')->label(__('general.basic-information.bio'))->label(__('general.basic-information.bio')),
                        TextInput::make('username')->prefix(env('APP_URL'))->unique(table: ProfileModel::class, ignorable: $this->profile)->label(__('general.basic-information.username')),
                        TextInput::make('email')->label(__('general.basic-information.email')),
                        TextInput::make('phone')->label(__('general.basic-information.phone')),
                        Select::make('gender')
                            ->label(__('general.basic-information.gender'))
                            ->searchable()
                            ->options([
                                1 => __('general.gender-types.male'),
                                0 => __('general.gender-types.female'),
                            ])->disabled(),
                        DatePicker::make('dob')->native(false)->disabled()->label(__('general.basic-information.dob')),
                        FileUpload::make('video')->acceptedFileTypes(['video/mp4', 'video/mov'])->label(__('general.basic-information.video')),
                    ]),
                Section::make(__('general.basic-information.location'))
                    ->collapsible()
                    ->schema([
                        Select::make('country_id')
                            ->label(__('general.basic-information.country'))
                            ->required()
                            ->options(Country::all()->pluck('name', 'id'))
                            ->searchable(),
                        Select::make('nationality_id')
                            ->label(__('general.basic-information.nationality'))
                            ->searchable()
                            ->relationship('nationality', 'name')
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
                        TextInput::make('address')->label(__('general.basic-information.address')),
                    ]),
            ])
            ->statePath('data')
            ->model($this->profile);
    }

    public function create(): void
    {
        $profile = \App\Models\Profile::updateOrCreate(
            ['user_id' => auth()->id()],
            $this->form->getState()
        );
        $this->form->model($profile)->saveRelationships();
        Notification::make('saved')
            ->title(__('general.save-success-title'))  // Use translation for title
            ->body(__('general.save-success-body'))   // Use translation for body
            ->iconColor('success')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('visit-profile')
                ->label(__('general.visit-profile'))  // Use translation for label
                ->icon('hugeicons-link-forward')
                ->url(route('profile.index', ['profile' => $this->profile]))
                ->openUrlInNewTab(),
        ];
    }
}
