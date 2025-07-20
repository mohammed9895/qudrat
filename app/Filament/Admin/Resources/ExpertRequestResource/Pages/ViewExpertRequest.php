<?php

namespace App\Filament\Admin\Resources\ExpertRequestResource\Pages;

use App\Enums\ExpertRequestStatus;
use App\Filament\Admin\Resources\ExpertRequestResource;
use App\Models\ExpertRequest;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewExpertRequest extends ViewRecord
{
    protected static string $resource = ExpertRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label(__('general.approve'))
                ->icon('heroicon-o-check')
                ->color('success')
                ->requiresConfirmation()
                ->action(function (array $data, ExpertRequest $record) {
                    $record->update(['status' => ExpertRequestStatus::Approved]);
                    $record->profile->update(['is_expert' => true]);
                    Notification::make()
                        ->title(__('general.request-approved'))
                        ->success()
                        ->send();
                }),
            Action::make('reject')
                ->label(__('general.reject'))
                ->icon('heroicon-o-x-mark')
                ->color('danger')
                ->form([
                    Textarea::make('message')
                        ->label(__('general.message'))
                        ->required()
                        ->columnSpanFull(),
                ])
                ->action(function (array $data, ExpertRequest $record) {
                    $record->update(['status' => ExpertRequestStatus::Rejected, 'message' => $data['message']]);
                    Notification::make()
                        ->title(__('general.request-rejected'))
                        ->success()
                        ->send();
                }),
        ];
    }
}
