<?php

namespace App\Filament\Admin\Resources\DigitalLibraryPostCommentResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryPostCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDigitalLibraryPostComments extends ListRecords
{
    protected static string $resource = DigitalLibraryPostCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
