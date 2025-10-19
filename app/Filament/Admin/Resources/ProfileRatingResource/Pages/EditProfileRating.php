<?php

namespace App\Filament\Admin\Resources\ProfileRatingResource\Pages;

use App\Filament\Admin\Resources\ProfileRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfileRating extends EditRecord
{
    protected static string $resource = ProfileRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
