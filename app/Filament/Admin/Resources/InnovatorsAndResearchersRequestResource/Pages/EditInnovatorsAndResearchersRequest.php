<?php

namespace App\Filament\Admin\Resources\InnovatorsAndResearchersRequestResource\Pages;

use App\Filament\Admin\Resources\InnovatorsAndResearchersRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInnovatorsAndResearchersRequest extends EditRecord
{
    protected static string $resource = InnovatorsAndResearchersRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
