<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Educations extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-graduation-scroll';

    protected static string $view = 'filament.user.clusters.profile.pages.educations';
    protected static ?int $navigationSort = 2;


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
                Section::make('Educations')
                    ->schema([
                        Repeater::make('educations')
                            ->collapsible()
                            ->relationship('educations')
                            ->reorderable()
                            ->orderColumn('sort')
                            ->schema([
                                TextInput::make('school'),
                                TextInput::make('degree'),
                                TextInput::make('field_of_study'),
                                TextInput::make('grade'),
                                DatePicker::make('start_date')->native(false),
                                DatePicker::make('end_date')->native(false),
                                Toggle::make('graduated'),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['degree'] ?? null),
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
