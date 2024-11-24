<?php

namespace App\Filament\Clusters\Profile\Pages;

use App\Filament\Clusters\Profile;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Experiences extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.profile.pages.experiences';

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
                Section::make('Experiences')
                    ->collapsible()
                    ->headerActions([
                        Action::make('reload')
                            ->icon('heroicon-o-arrow-path')
                            ->action(function () {
                                dd('load');
                            }),
                    ])
                    ->schema([
                        Repeater::make('experiences')
                            ->collapsible()
                            ->relationship('experiences')
                            ->reorderable()
                            ->orderColumn('sort')
                            ->schema([
                                TextInput::make('company'),
                                TextInput::make('position'),
                                DatePicker::make('start_date')->native(false),
                                DatePicker::make('end_date')->native(false),
                                Toggle::make('is_current'),
                                MarkdownEditor::make('description'),
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
    }
}
