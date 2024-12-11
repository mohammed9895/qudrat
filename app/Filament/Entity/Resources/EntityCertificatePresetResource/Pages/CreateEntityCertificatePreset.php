<?php

namespace App\Filament\Entity\Resources\EntityCertificatePresetResource\Pages;

use App\Filament\Entity\Resources\EntityCertificatePresetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEntityCertificatePreset extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = EntityCertificatePresetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
