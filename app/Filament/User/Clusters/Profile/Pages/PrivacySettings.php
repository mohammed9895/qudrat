<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class PrivacySettings extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-locked';

    protected static string $view = 'filament.user.clusters.profile.pages.privacy-settings';

    public static function getNavigationLabel(): string
    {
        return __('general.privacy_settings.title');
    }

    public function getTitle(): string|Htmlable
    {
        return __('general.privacy_settings.title');
    }

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 9;

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

                Section::make(__('general.privacy_settings.title'))  // Use translated title for section
                    ->collapsible()
                    ->schema([
                        Toggle::make('public_profile')
                            ->label(__('general.privacy_settings.public_profile'))  // Use translated label for public_profile
                            ->hint(__('general.privacy_settings.public_profile_hint')),  // Use translated hint
                        Toggle::make('can_send_message')
                            ->label(__('general.privacy_settings.can_send_message'))  // Use translated label for can_send_message
                            ->hint(__('general.privacy_settings.can_send_message_hint')),  // Use translated hint
                        Toggle::make('show_email')
                            ->label(__('general.privacy_settings.show_email'))  // Use translated label for show_email
                            ->hint(__('general.privacy_settings.show_email_hint')),  // Use translated hint
                        Toggle::make('show_phone')
                            ->label(__('general.privacy_settings.show_phone'))  // Use translated label for show_phone
                            ->hint(__('general.privacy_settings.show_phone_hint')),  // Use translated hint
                        Toggle::make('show_location')
                            ->label(__('general.privacy_settings.show_location'))  // Use translated label for show_location
                            ->hint(__('general.privacy_settings.show_location_hint')),  // Use translated hint
                        Toggle::make('show_social_links')
                            ->label(__('general.privacy_settings.show_social_links'))  // Use translated label for show_social_links
                            ->hint(__('general.privacy_settings.show_social_links_hint')),  // Use translated hint
                        Toggle::make('show_rating')
                            ->label(__('general.privacy_settings.show_rating'))  // Use translated label for show_rating
                            ->hint(__('general.privacy_settings.show_rating_hint')),  // Use translated hint
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
