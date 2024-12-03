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
use Filament\Pages\Page;

class Courses extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-course';

    protected static string $view = 'filament.user.clusters.profile.pages.courses';

    protected static ?int $navigationSort = 6;

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
                Section::make('Courses')
                ->schema([
                    Repeater::make('courses')
                        ->collapsible()
                        ->hiddenLabel()
                        ->relationship('courses')
                        ->reorderable()
                        ->orderColumn('sort')
                        ->schema([
                            TextInput::make('title'),
                            TextInput::make('organization'),
                            DatePicker::make('start_date')->native(false),
                            DatePicker::make('end_date')->native(false),
                            FileUpload::make('certificate_file'),
                            MarkdownEditor::make('description'),
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
    }
}
