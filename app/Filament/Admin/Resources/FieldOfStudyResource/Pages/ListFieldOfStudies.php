<?php

namespace App\Filament\Admin\Resources\FieldOfStudyResource\Pages;

use App\Filament\Admin\Resources\FieldOfStudyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFieldOfStudies extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FieldOfStudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
