<?php

namespace App\Filament\Admin\Resources\WorkTagResource\Pages;

use App\Filament\Admin\Resources\WorkTagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkTags extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = WorkTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
