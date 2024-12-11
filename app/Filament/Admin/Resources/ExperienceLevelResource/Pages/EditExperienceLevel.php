<?php

namespace App\Filament\Admin\Resources\ExperienceLevelResource\Pages;

use App\Filament\Admin\Resources\ExperienceLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExperienceLevel extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ExperienceLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
