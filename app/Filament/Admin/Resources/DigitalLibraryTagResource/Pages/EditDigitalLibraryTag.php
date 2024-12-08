<?php

namespace App\Filament\Admin\Resources\DigitalLibraryTagResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryTagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalLibraryTag extends EditRecord
{
    protected static string $resource = DigitalLibraryTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
