<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DigitalLibraryTagResource\Pages;
use App\Filament\Admin\Resources\DigitalLibraryTagResource\RelationManagers;
use App\Models\DigitalLibraryTag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DigitalLibraryTagResource extends Resource
{
    protected static ?string $model = DigitalLibraryTag::class;

    protected static ?string $navigationIcon = 'hugeicons-tags';

    protected static ?string $navigationGroup = 'Digital Library';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', $state))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
            'index' => Pages\ListDigitalLibraryTags::route('/'),
            'create' => Pages\CreateDigitalLibraryTag::route('/create'),
            'edit' => Pages\EditDigitalLibraryTag::route('/{record}/edit'),
        ];
    }
}
