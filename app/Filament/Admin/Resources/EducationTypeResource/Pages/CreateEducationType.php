<?php

namespace App\Filament\Admin\Resources\EducationTypeResource\Pages;

use App\Filament\Admin\Resources\EducationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEducationType extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = EducationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
