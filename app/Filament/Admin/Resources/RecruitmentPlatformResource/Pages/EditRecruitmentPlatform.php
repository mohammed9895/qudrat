<?php

namespace App\Filament\Admin\Resources\RecruitmentPlatformResource\Pages;

use App\Filament\Admin\Resources\RecruitmentPlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecruitmentPlatform extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = RecruitmentPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
