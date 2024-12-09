<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use App\Models\Country;
use App\Models\Province;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class PrivacySettings extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-locked';

    protected static string $view = 'filament.user.clusters.profile.pages.privacy-settings';

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
                Section::make('Basic Information')
                    ->collapsible()
                    ->schema([
                       Toggle::make('public_profile')
                            ->hint('If you enable this, your profile will be visible to everyone.'),
                        Toggle::make('can_send_message')
                                ->hint('If you enable this, other users can send you messages.'),
                        Toggle::make('show_email')
                            ->hint('If you enable this, your email will be visible to everyone.'),
                        Toggle::make('show_phone')
                            ->hint('If you enable this, your phone number will be visible to everyone.'),
                        Toggle::make('show_location')
                            ->hint('If you enable this, your location will be visible to everyone.'),
                        Toggle::make('show_social_links')
                            ->hint('If you enable this, your social links will be visible to everyone.'),
                        Toggle::make('show_rating')
                            ->hint('If you enable this, your rating will be visible to everyone.'),
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
