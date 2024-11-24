<?php

namespace App\Filament\Clusters\Profile\Pages;

use App\Filament\Clusters\Profile;
use App\Models\Country;
use App\Models\Province;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;

class UpdateProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.profile.pages.update-profile';

    protected static ?string $cluster = Profile::class;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               Section::make('Basic Information')
                ->schema([
                    FileUpload::make('avatar')->avatar(),
                    TextInput::make('fullname'),
                    TextInput::make('position'),
                    MarkdownEditor::make('bio'),
                    TextInput::make('username')->prefix('https://qudrat.om/'),
                    TextInput::make('email'),
                    TextInput::make('phone'),
                    Select::make('gender')
                        ->searchable()
                        ->options(['Male', 'Female']),
                    DatePicker::make('dob')->native(false),
                    FileUpload::make('video'),
                ]),
                Section::make('Location')
                ->schema([
                    Select::make('country_id')
                        ->label('Country')
                        ->required()
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable(),
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
                Section::make('More About You')
                    ->schema([
                        TagsInput::make('categories'),
                        TagsInput::make('skills'),
                        TagsInput::make('interests'),
                        TagsInput::make('languages'),
                        TagsInput::make('tools'),
                    ]),
                Section::make('Social Media')
                    ->schema([
                        TextInput::make('website'),
                        TextInput::make('social_facebook'),
                        TextInput::make('social_x'),
                        TextInput::make('social_linkedin'),
                        TextInput::make('social_instagram'),
                        TextInput::make('social_youtube'),
                        TextInput::make('social_github'),
                    ]),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
       \App\Models\Profile::updateOrCreate(
            ['user_id' => auth()->id()],
            $this->data
        );

    }
}
