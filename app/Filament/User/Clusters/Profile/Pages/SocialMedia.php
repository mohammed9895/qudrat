<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SocialMedia extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-share-08';

    protected static string $view = 'filament.user.clusters.profile.pages.social-media';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 8;

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
                Section::make('Social Media')
                    ->collapsible()
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
