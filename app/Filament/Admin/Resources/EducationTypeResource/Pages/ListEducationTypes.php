<?php

namespace App\Filament\Admin\Resources\EducationTypeResource\Pages;

use App\Filament\Admin\Resources\EducationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationTypes extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = EducationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
