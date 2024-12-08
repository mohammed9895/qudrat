<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\Section;
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
                        TagsInput::make('categories')
                            ->hint('Add categories that you are interested in and press enter')
                            ->placeholder('add category'),
                        TagsInput::make('skills')
                            ->hint('Add skills that you have and press enter')
                        ->placeholder('add skill'),
                        TagsInput::make('interested')
                            ->hint('Add what you are interested in and press enter')
                        ->placeholder('add interested'),
                        TagsInput::make('languages')
                            ->hint('Add languages that you know and press enter')
                        ->placeholder('add language'),
                        TagsInput::make('tools')
                            ->hint('Add tools that you use and press enter')
                        ->placeholder('add tool'),
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
