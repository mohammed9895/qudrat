<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class MoreAboutYou extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-user-search-01';

    protected static string $view = 'filament.user.clusters.profile.pages.more-about-you';

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
                        Select::make('categories')
                            ->preload()
                            ->hint('Add categories that you are interested in and press enter')
                            ->searchable()
                            ->multiple()
                            ->relationship('categories', 'name'),
                        Select::make('skills')
                            ->preload()
                            ->multiple()
                            ->relationship('skills', 'name')
                            ->searchable()
                            ->hint('Add skills that you have and press enter'),
                        Select::make('interests')
                            ->preload()
                            ->multiple()
                            ->relationship('interests', 'name')
                            ->hint('Add what you are interested in and press enter')
                            ->searchable(),
                        Select::make('languages')
                            ->preload()
                            ->multiple()
                            ->relationship('languages', 'name')
                            ->hint('Add languages that you know and press enter')
                            ->searchable(),
                        Select::make('tools')
                            ->preload()
                            ->multiple()
                            ->relationship('tools', 'name')
                            ->searchable()
                            ->placeholder('select a tool')
                            ->hint('Add tools that you use and press enter'),
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
