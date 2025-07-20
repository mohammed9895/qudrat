<?php

namespace App\Actions;

use App\Enums\Status;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class ActivateAction extends Action
{
    public static function make(?string $name = 'active'): static
    {
        return parent::make($name)
            ->label(__('general.activate'))
            ->icon('heroicon-o-check')
            ->color('success')
            ->hidden(fn ($record) => $record->status === Status::Active)
            ->action(function ($record) {
                $record->update(['status' => Status::Active->value]);

                Notification::make()
                    ->title(__('general.success'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->body(__('general.activated_successfully'))
                    ->send();
            });
    }
}
