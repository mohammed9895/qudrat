<?php

namespace App\Filament\Admin\Resources\ExpertRequestResource\Pages;

use App\Filament\Admin\Resources\ExpertRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExpertRequests extends ListRecords
{
    protected static string $resource = ExpertRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
