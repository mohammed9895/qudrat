<?php

namespace App\Filament\Admin\Resources\SkillResource\Pages;

use App\Filament\Admin\Resources\SkillResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkills extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = SkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
