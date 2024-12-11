<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WorkCategoryResource\Pages;
use App\Filament\Admin\Resources\WorkCategoryResource\RelationManagers;
use App\Models\WorkCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class WorkCategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = WorkCategory::class;

    protected static ?string $navigationIcon = 'hugeicons-sticky-note-02';

    protected static ?string $navigationGroup = 'Works';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->live(true)
                        ->afterStateUpdated(fn(?string $state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->unique()
                        ->required(),
                    Forms\Components\Select::make('parent_id')
                        ->relationship('parent', 'name')
                        ->nullable()
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('status'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkCategories::route('/'),
            'create' => Pages\CreateWorkCategory::route('/create'),
            'edit' => Pages\EditWorkCategory::route('/{record}/edit'),
        ];
    }
}
