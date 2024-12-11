<?php

namespace App\Filament\Admin\Resources\FieldOfStudyResource\Pages;

use App\Filament\Admin\Resources\FieldOfStudyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFieldOfStudy extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FieldOfStudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
