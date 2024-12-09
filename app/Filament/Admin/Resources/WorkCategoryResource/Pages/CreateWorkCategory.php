<?php

namespace App\Filament\Admin\Resources\WorkCategoryResource\Pages;

use App\Filament\Admin\Resources\WorkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkCategory extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = WorkCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
