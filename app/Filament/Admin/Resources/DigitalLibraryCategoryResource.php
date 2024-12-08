<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DigitalLibraryCategoryResource\Pages;
use App\Filament\Admin\Resources\DigitalLibraryCategoryResource\RelationManagers;
use App\Models\DigitalLibraryCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class DigitalLibraryCategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = DigitalLibraryCategory::class;

    protected static ?string $navigationIcon = 'hugeicons-sticky-note-02';

    protected static ?string $navigationGroup = 'Digital Library';

    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->maxLength(255),
                            Forms\Components\TextInput::make('slug')
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->maxLength(255)
                                ->unique(DigitalLibraryCategory::class, 'slug', ignoreRecord: true),
                            Forms\Components\RichEditor::make('description')
                                ->columnSpanFull(),
                        ])->columns(2),
                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image(),
                    ])
                ])->columnSpan(2),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\Toggle::make('status'),
                            Forms\Components\Select::make('parent_id')
                                ->relationship('parent', 'name'),
                        ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('parent_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DigitalLibraryPostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDigitalLibraryCategories::route('/'),
            'create' => Pages\CreateDigitalLibraryCategory::route('/create'),
            'edit' => Pages\EditDigitalLibraryCategory::route('/{record}/edit'),
        ];
    }
}
