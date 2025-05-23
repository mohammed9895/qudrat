<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\WorkResource\Pages;
use App\Models\Work;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class WorkResource extends Resource
{
    protected static ?string $model = Work::class;

    protected static ?string $navigationIcon = 'hugeicons-work-history';

    protected static ?int $navigationSort = 3;

    public static function getLabel(): ?string
    {
        return __('general.work_resource.title');
    }

    public static function getPluralLabel(): ?string
    {
        return __('general.work_resource.title_p');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.work_resource.work_detials'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('general.work_resource.title_label'))
                            ->required()
                            ->afterStateUpdated(fn (?string $state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('general.work_resource.slug_label'))
                            ->required()
                            ->maxLength(255)
                            ->unique(table: Work::class),
                        Forms\Components\Select::make('work_category_id')
                            ->label(__('general.work_resource.category_label'))
                            ->relationship('workCategory', 'name')
                            ->searchable(),
                        Forms\Components\TextInput::make('link')
                            ->label(__('general.work_resource.link_label'))
                            ->prefixIcon('heroicon-o-link')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->label(__('general.work_resource.description_label'))
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('workTags')
                            ->label(__('general.work_resource.tags_label'))
                            ->preload()
                            ->multiple()
                            ->relationship('workTags', 'name')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('skills')
                            ->label(__('general.work_resource.skills_label'))
                            ->preload()
                            ->multiple()
                            ->searchable()
                            ->relationship('skills', 'name'),
                        Forms\Components\Select::make('tools')
                            ->label(__('general.work_resource.tools_label'))
                            ->preload()
                            ->multiple()
                            ->searchable()
                            ->relationship('tools', 'name'),
                        Forms\Components\Toggle::make('status')
                            ->label(__('general.work_resource.status_label')),
                    ])->columns(2),
                Section::make(__('general.work_resource.attachments'))
                    ->schema([
                        Forms\Components\FileUpload::make('cover')
                            ->label(__('general.work_resource.cover_label'))
                            ->required(),
                        Forms\Components\FileUpload::make('images')
                            ->label(__('general.work_resource.images_label'))
                            ->multiple()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('video')
                            ->label(__('general.work_resource.video_label'))
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('attachments')
                            ->label(__('general.work_resource.attachments_label'))
                            ->multiple()
                            ->storeFileNamesIn('attachment_file_names')
                            ->columnSpanFull(),
                    ]),
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
            ->filters([/* your filters */])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginated([18, 36, 72, 'all'])
            ->actions([
                Tables\Actions\Action::make('visit')
                    ->label(__('general.work_resource.visit_button'))  // Use translated label for visit button
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (Work $record) => route('works.show', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()->label(__('general.work_resource.edit_button')),  // Use translated label for edit button
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function () {
                            Notification::make()
                                ->title(__('general.work_resource.delete_warning'))  // Use translated warning
                                ->warning()
                                ->send();
                        }),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
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
