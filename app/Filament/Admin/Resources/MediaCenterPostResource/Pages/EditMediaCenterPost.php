<?php

namespace App\Filament\Admin\Resources\MediaCenterPostResource\Pages;

use App\Filament\Admin\Resources\MediaCenterPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaCenterPost extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = MediaCenterPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
