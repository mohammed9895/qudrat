<?php

namespace App\Filament\Admin\Resources\WorkCategoryResource\Pages;

use App\Filament\Admin\Resources\WorkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = WorkCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
