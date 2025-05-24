<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class MoreAboutYou extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-user-search-01';

    protected static string $view = 'filament.user.clusters.profile.pages.more-about-you';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 7;

    public \App\Models\Profile $profile;

    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('general.more_about_you.title');
    }

    public function getTitle(): string|Htmlable
    {
        return __('general.more_about_you.title');
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

                Section::make(__('general.more_about_you.title'))  // Use translated title for section
                    ->collapsible()
                    ->schema([
                        Select::make('categories')
                            ->preload()
                            ->label(__('general.more_about_you.categories'))  // Use translated label for categories
                            ->hint(__('general.more_about_you.add_hint'))  // Use translated hint for categories
                            ->searchable()
                            ->multiple()
                            ->hintAction(
                                Action::make('ai-recommendation')
                                    ->label(__('general.ai.title'))  // Use translation for label
                                    ->icon('hugeicons-ai-brain-03')
                                    ->modalContent(function () {
                                        $recommendation = $this->profile
                                            ->getSectionRecommendation('categories')[app()->getLocale()] ?? [];

                                        return view('filament.user.pages.actions.education-ai', [
                                            'recommendation' => $recommendation,
                                        ]);
                                    })->modalSubmitAction(false), // Use translation for heading,
                            )
                            ->relationship('categories', 'name'),
                        Select::make('skills')
                            ->preload()
                            ->label(__('general.more_about_you.skills'))  // Use translated label for skills
                            ->multiple()
                            ->hintAction(
                                Action::make('ai-recommendation')
                                    ->label(__('general.ai.title'))  // Use translation for label
                                    ->icon('hugeicons-ai-brain-03')
                                    ->modalContent(function () {
                                        $recommendation = $this->profile
                                            ->getSectionRecommendation('skills')[app()->getLocale()] ?? [];

                                        return view('filament.user.pages.actions.education-ai', [
                                            'recommendation' => $recommendation,
                                        ]);
                                    })->modalSubmitAction(false), // Use translation for heading,
                            )
                            ->relationship('skills', 'name')
                            ->searchable()
                            ->hint(__('general.more_about_you.skills_hint')),  // Use translated hint for skills
                        Select::make('interests')
                            ->preload()
                            ->label(__('general.more_about_you.interests'))  // Use translated label for interests
                            ->multiple()
                            ->hintAction(
                                Action::make('ai-recommendation')
                                    ->label(__('general.ai.title'))  // Use translation for label
                                    ->icon('hugeicons-ai-brain-03')
                                    ->modalContent(function () {
                                        $recommendation = $this->profile
                                            ->getSectionRecommendation('interests')[app()->getLocale()] ?? [];

                                        return view('filament.user.pages.actions.education-ai', [
                                            'recommendation' => $recommendation,
                                        ]);
                                    })->modalSubmitAction(false), // Use translation for heading,
                            )
                            ->relationship('interests', 'name')
                            ->hint(__('general.more_about_you.interests_hint'))  // Use translated hint for interests
                            ->searchable(),
                        Select::make('languages')
                            ->preload()
                            ->label(__('general.more_about_you.languages'))  // Use translated label for languages
                            ->multiple()
                            ->hintAction(
                                Action::make('ai-recommendation')
                                    ->label(__('general.ai.title'))  // Use translation for label
                                    ->icon('hugeicons-ai-brain-03')
                                    ->modalContent(function () {
                                        $recommendation = $this->profile
                                            ->getSectionRecommendation('languages')[app()->getLocale()] ?? [];

                                        return view('filament.user.pages.actions.education-ai', [
                                            'recommendation' => $recommendation,
                                        ]);
                                    })->modalSubmitAction(false), // Use translation for heading,
                            )
                            ->relationship('languages', 'name')
                            ->hint(__('general.more_about_you.languages_hint'))  // Use translated hint for languages
                            ->searchable(),
                        Select::make('tools')
                            ->preload()
                            ->label(__('general.more_about_you.tools'))  // Use translated label for tools
                            ->multiple()
                            ->relationship('tools', 'name')
                            ->searchable()
                            ->hintAction(
                                Action::make('ai-recommendation')
                                    ->label(__('general.ai.title'))  // Use translation for label
                                    ->icon('hugeicons-ai-brain-03')
                                    ->modalContent(function () {
                                        $recommendation = $this->profile
                                            ->getSectionRecommendation('tools')[app()->getLocale()] ?? [];

                                        return view('filament.user.pages.actions.education-ai', [
                                            'recommendation' => $recommendation,
                                        ]);
                                    })->modalSubmitAction(false), // Use translation for heading,
                            )
                            ->placeholder(__('general.more_about_you.tools'))  // Use translated placeholder for tools
                            ->hint(__('general.more_about_you.tools_hint')),   // Use translated hint for tools
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
