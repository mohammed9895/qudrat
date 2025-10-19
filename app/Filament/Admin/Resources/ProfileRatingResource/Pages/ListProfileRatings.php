<?php

namespace App\Filament\Admin\Resources\ProfileRatingResource\Pages;

use App\Filament\Admin\Resources\ProfileRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfileRatings extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ProfileRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
