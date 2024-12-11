<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProfileResource\Pages;
use App\Filament\Admin\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'hugeicons-profile-02';

    protected static ?string $navigationGroup = 'Profiles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('fullname')
                    ->maxLength(255),
                Forms\Components\TextInput::make('username')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('avatar')
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->maxLength(255),
                Forms\Components\Textarea::make('bio')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\TextInput::make('video')
                    ->maxLength(255),
                Forms\Components\TextInput::make('country_id')
                    ->numeric(),
                Forms\Components\TextInput::make('province_id')
                    ->numeric(),
                Forms\Components\TextInput::make('state_id')
                    ->numeric(),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('company')
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255),
                Forms\Components\TextInput::make('skills'),
                Forms\Components\TextInput::make('languages'),
                Forms\Components\TextInput::make('tools'),
                Forms\Components\TextInput::make('categories'),
                Forms\Components\TextInput::make('interested'),
                Forms\Components\TextInput::make('social_facebook')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_x')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_linkedin')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_github')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_stackoverflow')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_youtube')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_instagram')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_pinterest')
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_whatsapp')
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fullname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('avatar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('video')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('province_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_facebook')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_x')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_linkedin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_github')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_stackoverflow')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_youtube')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_instagram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_pinterest')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_whatsapp')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
