<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Status;
use App\Filament\Admin\Resources\WorkResource\Pages;
use App\Filament\Admin\Resources\WorkResource\RelationManagers;
use App\Models\Work;
use Filament\Forms;
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

    protected static ?string $navigationGroup = 'Works';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('work_category_id')
                    ->relationship('workCategory', 'name')
                    ->required(),
                Forms\Components\Select::make('profile_id')
                    ->relationship('profile', 'id')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('images')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('cover')
                    ->maxLength(255),
                Forms\Components\Textarea::make('video')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('attachments')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('attachment_file_names')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('link')
                    ->maxLength(255),
                Forms\Components\Textarea::make('tools')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(1),
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
            ->filters([
                Tables\Filters\SelectFilter::make('profile')
                    ->relationship('profile', 'fullname')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('status')
                    ->options(Status::class),
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
            'index' => Pages\ListWorks::route('/'),
            'create' => Pages\CreateWork::route('/create'),
            'edit' => Pages\EditWork::route('/{record}/edit'),
        ];
    }
}
