<?php

namespace App\Filament\Admin\Resources\InnovatorsAndResearchersRequestResource\Pages;

use App\Enums\ExpertRequestStatus;
use App\Filament\Admin\Resources\InnovatorsAndResearchersRequestResource;
use App\Models\ExpertRequest;
use App\Models\InnovatorsAndResearchersRequest;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\DB;

class ViewInnovatorsAndResearchersRequest extends ViewRecord
{
    protected static string $resource = InnovatorsAndResearchersRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label(__('general.approve'))
                ->icon('heroicon-o-check')
                ->color('success')
                ->requiresConfirmation()
                ->action(function (array $data, InnovatorsAndResearchersRequest $record) {
                    DB::transaction(function () use ($record) {
                        $record->update(['status' => ExpertRequestStatus::Approved]);
                        $record->profile->update(['is_expert' => true]);

                        if ($record->category_id) {
                            // attach without removing existing categories
                            $record->profile->categories()->syncWithoutDetaching([$record->category_id]);
                        }
                    });

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

                    //                    Mail::to($record->profile->email)->send(new ExpertRequestRejected(
                    //                        name: $record->profile->fullname,
                    //                        message: $data['message']
                    //                    ));

                    Notification::make()
                        ->title(__('general.request-rejected'))
                        ->success()
                        ->send();
                }),
        ];
    }
}
