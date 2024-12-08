<?php

namespace App\Filament\Admin\Resources\DigitalLibraryPostCommentResource\Pages;

use App\Filament\Admin\Resources\DigitalLibraryPostCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalLibraryPostComment extends EditRecord
{
    protected static string $resource = DigitalLibraryPostCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
