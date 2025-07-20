<?php

namespace App\Filament\Admin\Resources\ExpertRequestResource\Pages;

use App\Filament\Admin\Resources\ExpertRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExpertRequest extends EditRecord
{
    protected static string $resource = ExpertRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
