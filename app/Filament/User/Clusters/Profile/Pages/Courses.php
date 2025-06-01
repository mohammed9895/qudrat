<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Http;

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

    public function getTitle(): string|Htmlable
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
                                Select::make('title')
                                ->searchable()
                            ->getSearchResultsUsing(function ($query) {
        // Make the API request using the query input for filtering
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post('https://jobseeker.mol.gov.om/js/gup/NewREG.aspx/tranCourseList', [
            'prefix' => $query, // Using search query to filter the results
        ]);

        // Check if the response is successful
        if ($response->successful()) {
            // Access the 'd' field which contains the list of course names with IDs
            $data = $response->json()['d'];
            $options = [];

            // Loop through the data to create key-value pairs for the options
            foreach ($data as $item) {
                // Split the string into name and ID parts
                $parts = explode('-', $item);
                if (count($parts) == 2) {
                    // Assign the ID as the value but display only the name in the dropdown
                    $options[$parts[0]] = $parts[0];// Use ID as value, name as label
                }
            }

             if (empty($options)) {
                $options[$query] = $query; // Use the search query as both the value and label
            }

            return $options; // Return the options for the select field
        }

        // Return an empty array if the request fails
        return [];
    })
                                    ->label(__('general.courses.course_title')),  // Use translated label
                                Select::make('organization')
                                ->searchable()
                            ->getSearchResultsUsing(function ($query) {
        // Make the API request using the query input for filtering
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post('https://jobseeker.mol.gov.om/js/gup/NewREG.aspx/GetTranInstituteList', [
            'prefix' => $query, // Using search query to filter the results
        ]);

        // Check if the response is successful
        if ($response->successful()) {
            // Access the 'd' field which contains the list of course names with IDs
            $data = $response->json()['d'];
            $options = [];

            // Loop through the data to create key-value pairs for the options
            foreach ($data as $item) {
                // Split the string into name and ID parts
                $parts = explode('-', $item);
                if (count($parts) == 2) {
                    // Assign the ID as the value but display only the name in the dropdown
                     $options[$parts[0]] = $parts[0];// Use ID as value, name as label
                }
            }

            return $options; // Return the options for the select field
        }

        // Return an empty array if the request fails
        return [];
    })
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
                        ->getSectionRecommendation('courses')[app()->getLocale()] ?? [];

                    return view('filament.user.pages.actions.education-ai', [
                        'recommendation' => $recommendation,
                    ]);
                })->modalSubmitAction(false), // Use translation for heading,
        ];
    }
}
