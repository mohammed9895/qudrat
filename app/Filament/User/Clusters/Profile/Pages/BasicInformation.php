<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use App\Models\Country;
use App\Models\Province;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class BasicInformation extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-user-account';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.user.clusters.profile.pages.basic-information';

    protected static ?string $cluster = Profile::class;

    public \App\Models\Profile $profile;

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
               Section::make('Basic Information')
                   ->collapsible()
                ->schema([
                    FileUpload::make('avatar')->avatar(),
                    TextInput::make('fullname'),
                    TextInput::make('position'),
                    Select::make('experience_level_id')
                        ->preload()
                        ->label('Experience Level')
                        ->searchable()
                        ->relationship('experienceLevel', 'name'),
                    RichEditor::make('bio'),
                    TextInput::make('username')->prefix('https://qudrat.om/'),
                    TextInput::make('email'),
                    TextInput::make('phone'),
                    Select::make('gender')
                        ->searchable()
                        ->options(['Male', 'Female']),
                    DatePicker::make('dob')->native(false),
                    FileUpload::make('video')->acceptedFileTypes(['video/mp4', 'video/mov']),
                ]),
                Section::make('Location')
                    ->collapsible()
                ->schema([
                    Select::make('country_id')
                        ->label('Country')
                        ->required()
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable(),
                    Select::make('nationality_id')
                        ->label(__('Nationality'))
                        ->searchable()
                        ->relationship('nationality', 'name')
                        ->required(),
                    Select::make('province_id')
                        ->label(__('Province'))
                        ->required()
                        ->options(Province::all()->pluck('name', 'id'))
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(fn(Set $set) => $set('state_id', null)),
                    Select::make('state_id')
                        ->label(__('State'))
                        ->required()
                        ->options(function (Get $get) {
                            $province = Province::find($get('province_id'));
                            if (!$province) {
                                return State::all()->pluck('name', 'id');
                            }
                            return $province->states->pluck('name', 'id');
                        })
                        ->searchable(),
                    TextInput::make('address'),
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
            ->title('Saved')
            ->body('Your profile has been saved.')
            ->iconColor('success')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->send();
    }
}
