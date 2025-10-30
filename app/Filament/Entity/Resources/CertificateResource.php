<?php

namespace App\Filament\Entity\Resources;

use App\Filament\Entity\Resources\CertificateResource\Pages;
use App\Models\Certificate;
use App\Models\Profile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static ?string $navigationIcon = 'hugeicons-certificate-01';

    public static function getNavigationLabel(): string
    {
        return __('general.add-certificate');
    }

    public static function getPluralLabel(): ?string
    {
        return __('general.certificates-p');
    }

    public static function getModelLabel(): string
    {
        return __('general.certificate');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.certificate-details'))
                    ->schema([
                        Select::make('profile_id')
                            ->label(__('general.profile'))
                            ->searchable()
                            ->options(Profile::pluck('fullname', 'id')->toArray())
                            ->required(),

                        TextInput::make('title')
                            ->label(__('general.title'))
                            ->required(),

                        TextInput::make('organization')
                            ->label(__('general.organization'))
                            ->columnSpanFull(),

                        DatePicker::make('issued_date')
                            ->label(__('general.issued-date'))
                            ->maxDate(now()->format('Y-m-d'))
                            ->native(false),

                        DatePicker::make('expiry_date')
                            ->label(__('general.expiry-date'))
                            ->native(false),

                        FileUpload::make('certificate_file')
                            ->label(__('general.certificate-file'))
                            ->columnSpanFull(),
                    ])->columns(2),
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
                    ->url(fn ($record) => route('profile.index', $record->profile))
                    ->openUrlInNewTab()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('general.title'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('organization')
                    ->label(__('general.organization'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('issued_date')
                    ->label(__('general.issued-date'))
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('expiry_date')
                    ->label(__('general.expiry-date'))
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
            'index' => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'edit' => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
