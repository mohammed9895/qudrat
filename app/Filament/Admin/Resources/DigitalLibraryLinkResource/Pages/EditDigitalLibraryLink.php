<?php

namespace App\Filament\Admin\Resources\DigitalLibraryLinkResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalLibraryLink extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = DigitalLibraryLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
