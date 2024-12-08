<?php

namespace App\Filament\Admin\Resources\MediaCenterPostResource\Pages;

use App\Filament\Admin\Resources\MediaCenterPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaCenterPosts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = MediaCenterPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
