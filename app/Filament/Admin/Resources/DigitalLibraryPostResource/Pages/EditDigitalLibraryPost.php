<?php

namespace App\Filament\Admin\Resources\DigitalLibraryPostResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalLibraryPost extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = DigitalLibraryPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
