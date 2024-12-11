<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Certificates extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-certificate-01';

    protected static string $view = 'filament.user.clusters.profile.pages.certificates';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 4;

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
                Section::make('Certificates')
                    ->collapsible()
                    ->schema([
                        Repeater::make('certificates')
                            ->collapsible()
                            ->relationship('certificates')
                            ->reorderable()
                            ->orderColumn('sort')
                            ->schema([
                                TextInput::make('title'),
                                TextInput::make('organization'),
                                DatePicker::make('issued_date')
                                    ->maxDate(now()->format('Y-m-d'))
                                    ->native(false),
                                DatePicker::make('expiry_date')->native(false),
                                FileUpload::make('certificate_file'),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
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
