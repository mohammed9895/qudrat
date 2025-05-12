<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
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

class Courses extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-course';

    protected static string $view = 'filament.user.clusters.profile.pages.courses';

    protected static ?int $navigationSort = 6;

    protected static ?string $cluster = Profile::class;

    public \App\Models\Profile $profile;

    public ?array $data = [];

    public static function getNavigationLabel(): string 
    {
        return __('general.courses.title');
    }

    public function getTitle(): string | Htmlable
    {
        return __('general.courses.title');
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
                Section::make(__('general.courses.title'))  // Use translated title for courses
                    ->schema([
                        Repeater::make('courses')
                            ->collapsible()
                            ->hiddenLabel()
                            ->label(__('general.courses.title'))
                            ->relationship('courses')
                            ->reorderable()
                            ->orderColumn('sort')
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('general.courses.course_title')),  // Use translated label
                                TextInput::make('organization')
                                    ->label(__('general.courses.organization')),  // Use translated label
                                DatePicker::make('start_date')
                                    ->maxDate(now()->format('Y-m-d'))
                                    ->native(false)
                                    ->label(__('general.courses.start_date')),  // Use translated label
                                DatePicker::make('end_date')
                                    ->native(false)
                                    ->label(__('general.courses.end_date')),  // Use translated label
                                FileUpload::make('certificate_file')
                                    ->label(__('general.courses.certificate_file')),  // Use translated label
                                MarkdownEditor::make('description')
                                    ->label(__('general.courses.description')),  // Use translated label
                            ])
                    ])
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
