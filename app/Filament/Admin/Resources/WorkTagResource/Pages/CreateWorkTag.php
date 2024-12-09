<?php

namespace App\Filament\Admin\Resources\WorkTagResource\Pages;

use App\Filament\Admin\Resources\WorkTagResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkTag extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = WorkTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
