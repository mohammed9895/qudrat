<?php

namespace App\Filament\Clusters\Profile\Pages;

use App\Filament\Clusters\Profile;
use App\Models\Country;
use App\Models\Province;
use App\Models\State;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;

class MoreAboutYou extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-user-search-01';

    protected static string $view = 'filament.clusters.profile.pages.more-about-you';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 7;

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

                Section::make('More About You')
                    ->collapsible()
                    ->schema([
                        TagsInput::make('categories'),
                        TagsInput::make('skills'),
                        TagsInput::make('interests'),
                        TagsInput::make('languages'),
                        TagsInput::make('tools'),
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
    }
}
