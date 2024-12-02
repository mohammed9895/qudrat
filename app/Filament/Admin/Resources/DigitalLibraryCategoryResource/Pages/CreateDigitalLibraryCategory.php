<?php

namespace App\Filament\Admin\Resources\DigitalLibraryCategoryResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDigitalLibraryCategory extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = DigitalLibraryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
