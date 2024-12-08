<?php

namespace App\Actions;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use App\Enums\Status;

class ActivateAction extends Action
{
    public static function make(string|null $name = 'active'): static
    {
        return parent::make($name)
            ->label('Active')
            ->icon('heroicon-o-check')
            ->color('success')
            ->hidden(fn ($record) => $record->status === Status::Active)
            ->action(function ($record) {
                $record->update(['status' => Status::Active->value]); // Adjust `Status::Active` based on your implementation
                Notification::make()
                    ->title('Success')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->body('Comment has been activated.')
                    ->send();
            });
    }
}
