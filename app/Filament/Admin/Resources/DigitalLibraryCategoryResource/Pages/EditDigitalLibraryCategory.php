<?php

namespace App\Filament\Admin\Resources\DigitalLibraryCategoryResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalLibraryCategory extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = DigitalLibraryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
