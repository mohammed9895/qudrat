<?php

namespace App\Filament\Admin\Resources\MediaCenterPostResource\Pages;

use App\Filament\Admin\Resources\MediaCenterPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMediaCenterPost extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = MediaCenterPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
