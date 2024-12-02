<?php

namespace App\Filament\Admin\Resources\DigitalLibraryCategoryResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDigitalLibraryCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = DigitalLibraryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
