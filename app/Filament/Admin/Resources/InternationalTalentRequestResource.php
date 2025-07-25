<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\InternationalTalentRequestResource\Pages;
use App\Models\InternationalTalentRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InternationalTalentRequestResource extends Resource
{
    protected static ?string $model = InternationalTalentRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('general.navigation.profiles'); // TODO: Change the autogenerated stub
    }

    public static function getNavigationLabel(): string
    {
        return __('general.international_talent_requests'); // TODO: Change the autogenerated stub
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.international_talent_requests'); // TODO: Change the autogenerated stub
    }

    public static function getModelLabel(): string
    {
        return __('general.international_talent_requests'); // TODO: Change the autogenerated stub
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fullname')
                    ->label(__('general.fullname'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('general.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label(__('general.phone'))
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dob')
                    ->label(__('general.dob'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->label(__('general.country'))
                    ->maxLength(255),
                Forms\Components\Textarea::make('bio')
                    ->label(__('general.bio'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('cv')
                    ->label(__('general.cv'))
                    ->maxLength(255),
                Forms\Components\Textarea::make('portfolio')
                    ->label(__('general.portfolio'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('linkedin')
                    ->label(__('general.linkedin'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('github')
                    ->label(__('general.github'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('twitter')
                    ->label(__('general.twitter'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->label(__('general.website'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->label(__('general.status'))
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
                Forms\Components\TextInput::make('message')
                    ->label(__('general.message'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('attachments')
                    ->label(__('general.attachments'))
                    ->maxLength(255),
                Forms\Components\Textarea::make('reason')
                    ->label(__('general.reason'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->label(__('general.fullname'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('general.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('general.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->label(__('general.dob'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->label(__('general.country'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('cv')
                    ->label(__('general.cv'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('linkedin')
                    ->label(__('general.linkedin'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('github')
                    ->label(__('general.github'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('twitter')
                    ->label(__('general.twitter'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->label(__('general.website'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('general.status'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('general.message'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('attachments')
                    ->label(__('general.attachments'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('general.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make()
                ->schema([
                    TextEntry::make('fullname')
                        ->label(__('general.fullname')),
                    TextEntry::make('email')
                        ->label(__('general.email')),
                    TextEntry::make('phone')
                        ->label(__('general.phone')),
                    TextEntry::make('status')
                        ->badge()
                        ->formatStateUsing(fn (InternationalTalentRequest $record) => match ($record->status) {
                            'pending' => __('general.expert_request_status.pending'),
                            'approved' => __('general.expert_request_status.approved'),
                            'rejected' => __('general.expert_request_status.rejected'),
                            default => __('general.expert_request_status.unknown'),
                        })
                        ->label(__('general.status')),
                    TextEntry::make('dob')
                        ->label(__('general.dob')),
                    TextEntry::make('country')
                        ->label(__('general.country')),
                    TextEntry::make('cv')
                        ->label(__('general.cv')),
                    TextEntry::make('portfolio')
                        ->label(__('general.portfolio')),
                    TextEntry::make('linkedin')
                        ->label(__('general.linkedin')),
                    TextEntry::make('github')
                        ->label(__('general.github')),
                    TextEntry::make('twitter')
                        ->label(__('general.twitter')),
                    TextEntry::make('website')
                        ->label(__('general.website')),
                ])->columns(2),
            Section::make(__('general.bio'))
                ->schema([
                    TextEntry::make('bio')
                        ->hiddenLabel()
                        ->html()
                        ->label(__('general.bio')),
                ]),
            Section::make(__('general.attachments'))
                ->schema([
                    Actions::make([
                        Actions\Action::make('download_cv')
                            ->label(__('general.download-cv'))
                            ->icon('heroicon-o-arrow-down-tray')
                            ->action(function (InternationalTalentRequest $record) {
                                return response()->download(storage_path('app/public/'.$record->cv));
                            }),
                        Actions\Action::make('download_portfolio')
                            ->label(__('general.download-portfolio'))
                            ->icon('heroicon-o-arrow-down-tray')
                            ->action(function (InternationalTalentRequest $record) {
                                return response()->download(storage_path('app/public/'.$record->portfolio));
                            }),
                    ]),
                ]),
        ]); // TODO: Change the autogenerated stub
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
            'index' => Pages\ListInternationalTalentRequests::route('/'),
            'create' => Pages\CreateInternationalTalentRequest::route('/create'),
            'edit' => Pages\EditInternationalTalentRequest::route('/{record}/edit'),
            'view' => Pages\ViewInternationalTalentRequest::route('/{record}'),
        ];
    }
}
