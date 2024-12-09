<?php

namespace App\Filament\Admin\Resources\ToolResource\Pages;

use App\Filament\Admin\Resources\ToolResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTool extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
