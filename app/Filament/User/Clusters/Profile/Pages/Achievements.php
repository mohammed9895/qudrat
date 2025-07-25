<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Achievements extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-checkmark-square-03';

    protected static string $view = 'filament.user.clusters.profile.pages.achievements';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 5;

    public \App\Models\Profile $profile;

    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('general.achievements.title');
    }

    public function getTitle(): string|Htmlable
    {
        return __('general.achievements.title');
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
                Section::make(__('general.achievements.title'))  // Use translated title for achievements
                    ->collapsible()
                    ->schema([
                        Repeater::make('achievements')
                            ->collapsible()
                            ->label(__('general.achievements.title'))
                            ->relationship('achievements')
                            ->reorderable()
                            ->orderColumn('sort')
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('general.achievements.achievement_title')),  // Use translated label
                                MarkdownEditor::make('description')
                                    ->label(__('general.achievements.description')),  // Use translated label
                                DatePicker::make('date')
                                    ->maxDate(now()->format('Y-m-d'))
                                    ->native(false)
                                    ->label(__('general.achievements.date')),  // Use translated label
                                FileUpload::make('achievement_file')
                                    ->maxSize(3072)
                                    ->acceptedFileTypes([
                                        'application/pdf',
                                        'image/jpeg',
                                        'image/png',
                                        'image/webp',
                                        'image/gif',
                                        'image/svg+xml',
                                    ])
                                    ->label(__('general.achievements.achievement_file')),  // Use translated label
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

        // Use translations for notification
        Notification::make('saved')
            ->title(__('general.save-success-title'))  // Use translated title
            ->body(__('general.save-success-body'))   // Use translated body
            ->iconColor('success')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('visit-profile')
                ->label(__('general.visit-profile'))  // Use translation for label
                ->icon('hugeicons-link-forward')
                ->color('gray')
                ->url(route('profile.index', ['profile' => $this->profile]))
                ->openUrlInNewTab(),
            Action::make('ai-recommendation')
                ->label(__('general.ai.title'))  // Use translation for label
                ->icon('hugeicons-ai-brain-03')
                ->modalContent(function () {
                    $recommendation = $this->profile
                        ->getSectionRecommendation('achievements')[app()->getLocale()] ?? [];

                    return view('filament.user.pages.actions.education-ai', [
                        'recommendation' => $recommendation,
                    ]);
                })->modalSubmitAction(false), // Use translation for heading,
        ];
    }
}
