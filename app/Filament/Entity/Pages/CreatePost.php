<?php

namespace App\Filament\Entity\Pages;

use App\Models\MediaCenterPost;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CreatePost extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.entity.pages.create-post';

    public array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('general.create-post');  // Use translated label for CV Maker
    }

    public function getTitle(): string
    {
        return __('general.create-post');  // Use translated label for CV Maker
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.create-new-post'))
                    ->schema([
                        TextInput::make('title')
                            ->label(__('general.title'))
                            ->live(onBlur: true)
                            ->required()
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->label(__('general.slug'))
                            ->unique(MediaCenterPost::class, 'slug')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (HasForms $livewire, TextInput $component) {
                                $livewire->validateOnly($component->getStatePath());
                            }),

                        RichEditor::make('content')
                            ->label(__('general.content'))
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label(__('general.image')),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $this->data['user_id'] = auth()->id();

        MediaCenterPost::create($this->data);

        $this->reset();

        return Notification::make('success')
            ->title(__('general.success'))
            ->body(__('general.post-submitted-successfully'))
            ->success()
            ->send();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(MediaCenterPost::where('user_id', auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.user'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('general.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('general.slug'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('general.image')),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('general.status'))
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.created-at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('general.updated-at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
