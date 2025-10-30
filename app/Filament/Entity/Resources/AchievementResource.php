<?php

namespace App\Filament\Entity\Resources;

use App\Filament\Entity\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'hugeicons-checkmark-square-03';

    public static function getNavigationLabel(): string
    {
        return __('general.add-achievement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('general.achievements-p');
    }

    public static function getModelLabel(): string
    {
        return __('general.achievement');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('general.add-achievement'))
                    ->schema([
                        Select::make('profile_id')
                            ->label(__('general.profile'))
                            ->searchable()
                            ->options(Profile::pluck('fullname', 'id')->toArray())
                            ->required(),

                        TextInput::make('title')
                            ->label(__('general.title'))
                            ->required(),

                        MarkdownEditor::make('description')
                            ->label(__('general.description')),

                        DatePicker::make('date')
                            ->label(__('general.date'))
                            ->maxDate(now()->format('Y-m-d'))
                            ->native(false),

                        FileUpload::make('achievement_file')
                            ->label(__('general.achievement-file')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('addable_type', 'App\Models\User')
                    ->where('addable_id', auth()->id());
            })
            ->columns([
                Tables\Columns\TextColumn::make('profile.fullname')
                    ->label(__('general.profile'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('general.title'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label(__('general.date'))
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('addable.name')
                    ->label(__('general.added-by'))
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
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('general.edit')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('general.delete')),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
