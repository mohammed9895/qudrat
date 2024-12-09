<?php

namespace App\Filament\Admin\Resources\WorkCategoryResource\Pages;

use App\Filament\Admin\Resources\WorkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkCategory extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = WorkCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
