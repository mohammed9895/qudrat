<?php

namespace App\Filament\Admin\Resources;

use App\Actions\ActivateAction;
use App\Actions\DeactivateAction;
use App\Filament\Admin\Resources\DigitalLibraryPostCommentResource\Pages;
use App\Filament\Admin\Resources\DigitalLibraryPostCommentResource\RelationManagers;
use App\Models\DigitalLibraryPostComment;
use Filament\Actions\ForceDeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DigitalLibraryPostCommentResource extends Resource
{
    protected static ?string $model = DigitalLibraryPostComment::class;

    protected static ?string $navigationIcon = 'hugeicons-comment-02';

    protected static ?string $navigationGroup = 'Digital Library';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('digital_library_post_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('content')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('digitalLibraryPost.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ActivateAction::make(),
                DeactivateAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListDigitalLibraryPostComments::route('/'),
            'create' => Pages\CreateDigitalLibraryPostComment::route('/create'),
            'edit' => Pages\EditDigitalLibraryPostComment::route('/{record}/edit'),
        ];
    }
}
