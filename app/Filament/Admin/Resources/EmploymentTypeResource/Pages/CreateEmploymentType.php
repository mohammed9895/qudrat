<?php

namespace App\Filament\Admin\Resources\EmploymentTypeResource\Pages;

use App\Filament\Admin\Resources\EmploymentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmploymentType extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = EmploymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
