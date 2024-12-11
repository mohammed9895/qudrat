<?php

namespace App\Filament\Admin\Resources\EmploymentTypeResource\Pages;

use App\Filament\Admin\Resources\EmploymentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmploymentType extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = EmploymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
