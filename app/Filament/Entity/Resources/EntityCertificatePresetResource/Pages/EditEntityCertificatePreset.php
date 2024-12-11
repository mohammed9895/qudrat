<?php

namespace App\Filament\Entity\Resources\EntityCertificatePresetResource\Pages;

use App\Filament\Entity\Resources\EntityCertificatePresetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntityCertificatePreset extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = EntityCertificatePresetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
