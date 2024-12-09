<?php

namespace App\Filament\User\Resources\WorkResource\Pages;

use App\Filament\User\Resources\WorkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWork extends EditRecord
{
    protected static string $resource = WorkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
