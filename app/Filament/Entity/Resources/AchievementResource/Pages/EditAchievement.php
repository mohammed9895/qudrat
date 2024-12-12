<?php

namespace App\Filament\Entity\Resources\AchievementResource\Pages;

use App\Filament\Entity\Resources\AchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAchievement extends EditRecord
{
    protected static string $resource = AchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
