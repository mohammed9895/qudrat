<?php

namespace App\Filament\Admin\Resources\EducationTypeResource\Pages;

use App\Filament\Admin\Resources\EducationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationType extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = EducationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
