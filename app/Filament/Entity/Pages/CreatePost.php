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

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('')
                ->schema([
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->required()
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->maxLength(255),
                    TextInput::make('slug')->unique(MediaCenterPost::class, 'slug')->live()
                        ->afterStateUpdated(function (HasForms $livewire, TextInput $component) {
                            $livewire->validateOnly($component->getStatePath());
                        }),
                    RichEditor::make('content')
                        ->required()
                        ->columnSpanFull(),
                    FileUpload::make('image'),
                ]),
        ])
            ->statePath('data');
    }

    public function submit()
    {

        $this->data['user_id'] = 1;

        MediaCenterPost::create($this->data);

        $this->reset();

        return Notification::make('success')
            ->title('Success')
            ->body('Grate, your post submitted successfully')
            ->success()
            ->send();

    }

    public function table(Table $table): Table
    {

        return $table
            ->query(MediaCenterPost::where('user_id', auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
