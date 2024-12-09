<?php

namespace App\Filament\Admin\Resources\ToolResource\Pages;

use App\Filament\Admin\Resources\ToolResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTool extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
