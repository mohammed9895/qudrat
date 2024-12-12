<?php

namespace App\Filament\Entity\Resources;

use App\Filament\Entity\Resources\CertificateResource\Pages;
use App\Filament\Entity\Resources\CertificateResource\RelationManagers;
use App\Models\Certificate;
use Filament\Forms;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static ?string $navigationIcon = 'hugeicons-certificate-01';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('profile_id')
                            ->searchable()
                            ->options(\App\Models\Profile::pluck('fullname', 'id')->toArray())
                            ->required(),
                        TextInput::make('title'),
                        TextInput::make('organization')->columnSpanFull(),
                        DatePicker::make('issued_date')
                            ->maxDate(now()->format('Y-m-d'))
                            ->native(false),
                        DatePicker::make('expiry_date')->native(false),
                        FileUpload::make('certificate_file')->columnSpanFull(),
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
                    ->url(fn ($record) => route('profile.index', $record->profile))
                    ->openUrlInNewTab()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('organization')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issued_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('addable_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('addable.name')
                    ->numeric()
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
            'index' => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'edit' => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
