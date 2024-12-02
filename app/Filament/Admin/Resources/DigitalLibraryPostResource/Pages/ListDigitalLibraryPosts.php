<?php

namespace App\Filament\Admin\Resources\DigitalLibraryPostResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDigitalLibraryPosts extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = DigitalLibraryPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
