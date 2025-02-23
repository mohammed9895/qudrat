<?php

namespace App\Filament\Admin\Resources\DigitalLibraryLinkResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryLinkResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;

class CreateDigitalLibraryLink extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = DigitalLibraryLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
