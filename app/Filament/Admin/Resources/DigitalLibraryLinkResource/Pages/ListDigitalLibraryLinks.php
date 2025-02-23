<?php

namespace App\Filament\Admin\Resources\DigitalLibraryLinkResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDigitalLibraryLinks extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = DigitalLibraryLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
