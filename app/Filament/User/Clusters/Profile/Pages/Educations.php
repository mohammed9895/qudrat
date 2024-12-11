<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use App\Models\FieldOfStudy;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
                                Select::make('school_id')
                                    ->searchable()
                                    ->preload()
                                    ->relationship('school', 'name'),
                                Select::make('education_type_id')
                                    ->preload()
                                    ->searchable()
                                    ->relationship('educationType', 'name'),
                                Select::make('field_of_study_id')
                                    ->live(onBlur: true)
                                    ->preload()
                                    ->searchable()
                                    ->relationship('fieldOfStudy', 'name')
                                    ->afterStateUpdated(fn(Set $set) => $set('filed_of_study_child', null)),
                                Select::make('field_of_study_child_id')
                                    ->searchable()
                                    ->live()
                                    ->nullable()
                                    ->options(function (Get $get) {
                                        $field_of_study = FieldOfStudy::find($get('field_of_study'));
                                        if (!$field_of_study) {
                                            return null;
                                        }
                                        return $field_of_study->children->pluck('name', 'id');
                                    })
                                    ->label('Sub Field of Study'),
                                TextInput::make('grade'),
                                DatePicker::make('start_date')
                                    ->maxDate(now())
                                    ->native(false),
                                DatePicker::make('end_date')->native(false),
                                Toggle::make('graduated'),
                            ]),
//                            ->itemLabel(fn (array $state): ?string => $state['field_of_study_id'] . ' - ' . $state['education_type_id'] ?? null),
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
