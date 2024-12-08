<?php

namespace App\Filament\Admin\Resources\MediaCenterCommentResource\Pages;

use App\Filament\Admin\Resources\MediaCenterCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaCenterComments extends ListRecords
{
    protected static string $resource = MediaCenterCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
