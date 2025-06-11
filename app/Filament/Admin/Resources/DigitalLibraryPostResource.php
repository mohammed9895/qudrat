<?php

namespace App\Filament\Admin\Resources;

use App\Actions\ActivateAction;
use App\Actions\DeactivateAction;
use App\Filament\Admin\Resources\DigitalLibraryPostResource\Pages;
use App\Filament\Admin\Resources\DigitalLibraryPostResource\RelationManagers;
use App\Models\DigitalLibraryPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DigitalLibraryPostResource extends Resource
{
    use Translatable;

    protected static ?string $model = DigitalLibraryPost::class;

    protected static ?string $navigationIcon = 'hugeicons-profile';

    protected static ?string $navigationGroup = 'Digital Library';

    protected static ?int $navigationSort = 0;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                        
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('author_id')
                            ->relationship('author', 'name'),
                        Forms\Components\Select::make('digital_library_category_id')
                            ->required()
                            ->relationship('digitalLibraryCategory', 'name'),
                        Forms\Components\Toggle::make('is_featured'),
                        Forms\Components\Toggle::make('status'),
                    ])->columns(2),
                Forms\Components\Section::make('Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->directory('digital-library-posts')
                            ->image(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('digitalLibraryCategory.name')
                    ->openUrlInNewTab(true)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                ActivateAction::make(),
                DeactivateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
               Section::make()
                ->schema([
                    Split::make([
                        Grid::make(2)->schema([
                            Group::make([
                                TextEntry::make('title'),
                                TextEntry::make('author.name'),
                                IconEntry::make('is_featured')->boolean(),
                            ]),
                            Group::make([
                                TextEntry::make('slug'),
                                TextEntry::make('digitalLibraryCategory.name'),
                                TextEntry::make('status')->badge(),
                            ])
                        ]),
                        ImageEntry::make('image')
                            ->hiddenLabel()
                            ->grow(false),
                    ])->from('lg'),
                ]),
                Section::make('Content')
                    ->schema([
                        TextEntry::make('description')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getRecordSubNavigation(\Filament\Resources\Pages\Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewDigitalLibraryPost::class,
            Pages\EditDigitalLibraryPost::class,
            Pages\ManageDigitalLibraryPostComments::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDigitalLibraryPosts::route('/'),
            'create' => Pages\CreateDigitalLibraryPost::route('/create'),
            'edit' => Pages\EditDigitalLibraryPost::route('/{record}/edit'),
            'view' => Pages\ViewDigitalLibraryPost::route('/{record}'),
            'comments' => Pages\ManageDigitalLibraryPostComments::route('/{record}/comments'),
        ];
    }
}
