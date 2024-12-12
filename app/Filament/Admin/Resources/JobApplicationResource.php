<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Status;
use App\Filament\Admin\Resources\JobApplicationResource\Pages;
use App\Filament\Admin\Resources\JobApplicationResource\RelationManagers;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'hugeicons-permanent-job';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('apply_link')
                    ->required()
                    ->url()
                    ->maxLength(255),
                Forms\Components\Select::make('job_department_id')
                    ->required()
                    ->relationship('jobDepartment', 'name'),
                Forms\Components\Select::make('province_id')
                    ->required()
                    ->relationship('province', 'name'),
                Forms\Components\TextInput::make('salary')
                    ->prefix('OMR',)
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('employment_type_id')
                    ->required()
                    ->relationship('employmentType', 'name'),
                Forms\Components\Select::make('education_type_id')
                    ->required()
                    ->relationship('educationType', 'name'),
                Forms\Components\Select::make('experience_level_id')
                    ->required()
                    ->relationship('experienceLevel', 'name'),
                Forms\Components\Select::make('categories')
                    ->preload()
                    ->relationship('categories', 'name')
                    ->multiple(),
                Forms\Components\Select::make('skills')
                    ->preload()
                    ->relationship('skills', 'name')
                    ->multiple(),
                Forms\Components\Select::make('tools')
                    ->preload()
                    ->relationship('tools', 'name')
                    ->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('entity_id', auth()->user()->entity->id);
            })
            ->columns([
                Tables\Columns\TextColumn::make('entity.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('salary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employmentType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('educationType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('experienceLevel.name')
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
                Tables\Actions\Action::make('activate')->action(function (JobApplication $record) {
                    $record->update(['status' => Status::Active]);
                    Notification::make('success')
                        ->title('Job Application Activated')
                        ->body('The job application has been activated successfully.')
                        ->send();
                })->color('success')->icon('heroicon-o-check-circle'),
                Tables\Actions\Action::make('deactivate')->action(function (JobApplication $record) {
                    $record->update(['status' => Status::Inactive]);
                    Notification::make('success')
                        ->title('Job Application Deactivated')
                        ->body('The job application has been deactivated successfully.')
                        ->send();
                })->color('danger')->icon('heroicon-o-x-circle'),
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
            'index' => Pages\ListJobApplications::route('/'),
            'create' => Pages\CreateJobApplication::route('/create'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
}
