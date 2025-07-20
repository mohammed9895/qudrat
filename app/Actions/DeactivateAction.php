<?php

namespace App\Actions;

use App\Enums\Status;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class DeactivateAction extends Action
{
    public static function make(?string $name = 'deactivate'): static
    {
        return parent::make($name)
            ->label(__('general.deactivate'))
            ->icon('hugeicons-cancel-01')
            ->color('danger')
            ->hidden(fn ($record) => $record->status === Status::Inactive)
            ->action(function ($record) {
                $record->update(['status' => Status::Inactive->value]);

                Notification::make()
                    ->title(__('general.success'))
                    ->icon('hugeicons-cancel-01')
                    ->color('danger')
                    ->body(__('general.deactivated_successfully'))
                    ->send();
            });
    }
}
