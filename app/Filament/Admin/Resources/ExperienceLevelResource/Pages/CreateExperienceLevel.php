<?php

namespace App\Filament\Admin\Resources\ExperienceLevelResource\Pages;

use App\Filament\Admin\Resources\ExperienceLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExperienceLevel extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ExperienceLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

}
