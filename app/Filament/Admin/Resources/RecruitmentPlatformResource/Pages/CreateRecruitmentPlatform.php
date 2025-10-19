<?php

namespace App\Filament\Admin\Resources\RecruitmentPlatformResource\Pages;

use App\Filament\Admin\Resources\RecruitmentPlatformResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateRecruitmentPlatform extends CreateRecord
{
    use Translatable;

    protected static string $resource = RecruitmentPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
