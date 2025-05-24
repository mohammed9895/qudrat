<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use App\Models\FieldOfStudy;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

// use Filament\Forms\Components\Actions\Action;

class Educations extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-graduation-scroll';

    protected static string $view = 'filament.user.clusters.profile.pages.educations';

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = Profile::class;

    public \App\Models\Profile $profile;

    public ?array $data = [];

    public array $recommendations = [];

    public static function getNavigationLabel(): string
    {
        return __('general.educations.title');
    }

    public function getTitle(): string|Htmlable
    {
        return __('general.educations.title');
    }

    public function mount(): void
    {
        $this->profile = \App\Models\Profile::with([
            'user',
            'skills',
            'languages',
            'tools',
            'interests',
            'views',
            'works.skills',
            'educations.school',
            'educations.educationType',
            'educations.fieldOfStudy',
            'educations.fieldOfStudyChild',
            'experiences',
            'certificates',
            'courses',
            'achievements',
            'ratings.user.profile',
        ])->where('user_id', auth()->id())->firstOrFail();
        //        $this->fetchRecommendations();
        $this->form->fill($this->profile->toArray());
    }

    //    public function fetchRecommendations()
    //    {
    //        $userProfile = $this->profile->toRecommendationArray(); // using the method we defined earlier
    //        $this->recommendations = RecommendationService::getOrStoreEducationRecommendations($userProfile);
    //    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.educations.title'))  // Use translated title
                    ->schema([
                        Repeater::make('educations')
                            ->label(__('general.educations.title'))
                            ->collapsible()
                            ->relationship('educations')
                            ->reorderable()
                            ->deletable(true) // Disable default delete button
                            ->orderColumn('sort')
                            ->schema([
                                Hidden::make('addable_id'), // No need for hydration hacks
                                Select::make('school_id')
                                    ->searchable()
                                    ->preload()
                                    ->relationship('school', 'name')
                                    ->label(__('general.educations.school')),  // Use translated label
                                Select::make('education_type_id')
                                    ->preload()
                                    ->searchable()
                                    ->relationship('educationType', 'name')
                                    ->label(__('general.educations.education_type')),  // Use translated label
                                Select::make('field_of_study_id')
                                    ->live()
                                    ->preload()
                                    ->searchable()
                                    ->relationship('fieldOfStudy', 'name')
                                    ->label(__('general.educations.field_of_study')),  // Use translated label
                                Select::make('field_of_study_child_id')
                                    ->searchable()
                                    ->live()
                                    ->nullable()
                                    ->options(fn (Get $get): Collection => FieldOfStudy::query()
                                        ->where('parent_id', $get('field_of_study_id'))
                                        ->pluck('name', 'id'))
                                    ->label(__('general.educations.sub_field_of_study')),  // Use translated label
                                TextInput::make('grade')
                                    ->label(__('general.educations.grade')),  // Use translated label
                                DatePicker::make('start_date')
                                    ->maxDate(now())
                                    ->native(false)
                                    ->label(__('general.educations.start_date')),  // Use translated label
                                DatePicker::make('end_date')
                                    ->native(false)
                                    ->label(__('general.educations.end_date')),  // Use translated label
                                Toggle::make('graduated')
                                    ->label(__('general.educations.graduated')),  // Use translated label
                            ]),
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
                        ->getSectionRecommendation('educations')[app()->getLocale()] ?? [];

                    return view('filament.user.pages.actions.education-ai', [
                        'recommendation' => $recommendation,
                    ]);
                })->modalSubmitAction(false), // Use translation for heading,
        ];
    }
}
