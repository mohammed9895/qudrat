<?php

namespace App\Filament\Admin\Resources\RecruitmentPlatformResource\Pages;

use App\Filament\Admin\Resources\RecruitmentPlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecruitmentPlatforms extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = RecruitmentPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
