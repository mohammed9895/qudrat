<?php

namespace App\Actions;

use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use App\Enums\Status;

class DeactivateAction extends Action
{
    public static function make(?string $name = 'deactivate'): static
    {
        return parent::make($name)
            ->label('Deactivate')
            ->icon('hugeicons-cancel-01')
            ->color('danger')
            ->hidden(fn ($record) => $record->status === Status::Inactive) // Adjust for inactive state
            ->action(function ($record) {
                $record->update(['status' => Status::Inactive]); // Adjust `Status::Inactive` based on your implementation
                Notification::make()
                    ->title('Success')
                    ->icon('hugeicons-cancel-01')
                    ->color('danger')
                    ->body('Comment has been deactivated.')
                    ->send();
            });
    }
}
