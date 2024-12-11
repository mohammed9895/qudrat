<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\WorkResource\Pages;
use App\Filament\User\Resources\WorkResource\RelationManagers;
use App\Models\Work;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkResource extends Resource
{
    protected static ?string $model = Work::class;

    protected static ?string $navigationIcon = 'hugeicons-work-history';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->afterStateUpdated(fn(?string $state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('work_category_id')
                            ->relationship('workCategory', 'name')
                            ->searchable(),
                        Forms\Components\TextInput::make('link')
                            ->prefixIcon('heroicon-o-link')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('workTags')
                            ->multiple()
                            ->relationship('workTags', 'name')
                        ->columnSpanFull(),
                        Forms\Components\Toggle::make('status'),
                    ])->columns(2),
                Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('cover')
                            ->required(),
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('videos')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('attachments')
                            ->multiple()
                            ->storeFileNamesIn('attachment_file_names')
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('cover')
                        ->height('100%')
                        ->width('100%'),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('title')
                            ->weight(FontWeight::Bold),
                    ]),
                ])->space(3),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\ColorColumn::make('color')
                            ->grow(false),
                    ]),
                ])->collapsible(),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginated([
                18,
                36,
                72,
                'all',
            ])
            ->actions([
                Tables\Actions\Action::make('visit')
                    ->label('Visit Work')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (Work $record) => route('works.show', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function () {
                            Notification::make()
                                ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                                ->warning()
                                ->send();
                        }),
                ]),
            ])->modifyQueryUsing(function (Builder $query) {
                $query->where('profile_id', auth()->user()->profile->id);
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorks::route('/'),
            'create' => Pages\CreateWork::route('/create'),
            'edit' => Pages\EditWork::route('/{record}/edit'),
        ];
    }
}
