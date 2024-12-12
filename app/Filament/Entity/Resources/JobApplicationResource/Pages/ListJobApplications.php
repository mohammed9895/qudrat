<?php

namespace App\Filament\Entity\Resources\JobApplicationResource\Pages;

use App\Filament\Entity\Resources\JobApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobApplications extends ListRecords
{
    protected static string $resource = JobApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
