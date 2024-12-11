<?php

namespace App\Filament\Admin\Resources\ExperienceLevelResource\Pages;

use App\Filament\Admin\Resources\ExperienceLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExperienceLevels extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ExperienceLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
