<?php

namespace App\Filament\Admin\Resources\InternationalTalentRequestResource\Pages;

use App\Filament\Admin\Resources\InternationalTalentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInternationalTalentRequest extends EditRecord
{
    protected static string $resource = InternationalTalentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
