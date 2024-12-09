<?php

namespace App\Filament\Admin\Resources\ToolResource\Pages;

use App\Filament\Admin\Resources\ToolResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTools extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
