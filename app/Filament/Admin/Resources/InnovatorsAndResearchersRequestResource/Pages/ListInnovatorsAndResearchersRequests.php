<?php

namespace App\Filament\Admin\Resources\InnovatorsAndResearchersRequestResource\Pages;

use App\Filament\Admin\Resources\InnovatorsAndResearchersRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInnovatorsAndResearchersRequests extends ListRecords
{
    protected static string $resource = InnovatorsAndResearchersRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
