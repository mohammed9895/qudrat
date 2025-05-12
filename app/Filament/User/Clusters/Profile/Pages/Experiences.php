<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Experiences extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-new-job';

    protected static string $view = 'filament.user.clusters.profile.pages.experiences';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 3;

    public \App\Models\Profile $profile;

    public ?array $data = [];

    public static function getNavigationLabel(): string 
    {
        return __('general.experiences.title');
    }

    public function getTitle(): string | Htmlable
    {
        return __('general.experiences.title');
    }

    public function mount(): void
    {
        $this->profile = \App\Models\Profile::where('user_id', auth()->id())->first();
        $this->form->fill($this->profile->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.experiences.title'))  // Use translated title for experiences
                    ->collapsible()
                    ->schema([
                        Repeater::make('experiences')
                            ->collapsible()
                            ->label(__('general.experiences.title'))
                            ->relationship('experiences')
                            ->reorderable()
                            ->orderColumn('sort')
                            ->schema([
                                TextInput::make('company')
                                    ->label(__('general.experiences.company')),  // Use translated label
                                TextInput::make('position')
                                    ->label(__('general.experiences.position')),  // Use translated label
                                DatePicker::make('start_date')
                                    ->maxDate(now()->format('Y-m-d'))
                                    ->native(false)
                                    ->label(__('general.experiences.start_date')),  // Use translated label
                                DatePicker::make('end_date')
                                    ->native(false)
                                    ->label(__('general.experiences.end_date')),  // Use translated label
                                Toggle::make('is_current')
                                    ->label(__('general.experiences.is_current')),  // Use translated label
                                MarkdownEditor::make('description')
                                    ->label(__('general.experiences.description')),  // Use translated label
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['company'] ?? null),
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
