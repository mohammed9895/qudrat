<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class SocialMedia extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-share-08';

    protected static string $view = 'filament.user.clusters.profile.pages.social-media';

    public static function getNavigationLabel(): string
    {
        return __('general.social_media.title');
    }

    public function getTitle(): string|Htmlable
    {
        return __('general.social_media.title');
    }

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
                Section::make(__('general.social_media.title'))  // Use translated title for Social Media
                    ->collapsible()
                    ->schema([
                        TextInput::make('website')
                            ->label(__('general.social_media.website')),  // Use translated label for website
                        TextInput::make('social_facebook')
                            ->label(__('general.social_media.facebook')),  // Use translated label for Facebook
                        TextInput::make('social_x')
                            ->label(__('general.social_media.x')),  // Use translated label for X
                        TextInput::make('social_linkedin')
                            ->label(__('general.social_media.linkedin')),  // Use translated label for LinkedIn
                        TextInput::make('social_instagram')
                            ->label(__('general.social_media.instagram')),  // Use translated label for Instagram
                        TextInput::make('social_youtube')
                            ->label(__('general.social_media.youtube')),  // Use translated label for YouTube
                        TextInput::make('social_github')
                            ->label(__('general.social_media.github')),  // Use translated label for GitHub
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

        // Use translations for notification
        Notification::make('saved')
            ->title(__('general.save-success-title'))  // Use translated title
            ->body(__('general.save-success-body'))   // Use translated body
            ->iconColor('success')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->send();
    }
}
