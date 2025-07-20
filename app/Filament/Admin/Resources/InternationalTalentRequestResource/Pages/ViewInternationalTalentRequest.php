<?php

namespace App\Filament\Admin\Resources\InternationalTalentRequestResource\Pages;

use App\Filament\Admin\Resources\InternationalTalentRequestResource;
use App\Jobs\SendInternationalTalentAccountEmail;
use App\Jobs\SendInternationalTalentRejectionEmail;
use App\Models\InternationalTalentRequest;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewInternationalTalentRequest extends ViewRecord
{
    protected static string $resource = InternationalTalentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label(__('general.approve'))
                ->color('success')
                ->icon('heroicon-o-check')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'approved']);
                    $password = str()->random(10);
                    $user = User::create([
                        'name' => $this->record->fullname,
                        'email' => $this->record->email,
                        'password' => bcrypt($password),
                    ]);
                    SendInternationalTalentAccountEmail::dispatch(
                        $user->name,
                        $user->email,
                        $password
                    );
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
                ->action(function (array $data, InternationalTalentRequest $record) {
                    $record->update([
                        'status' => 'rejected',
                        'message' => $data['message'],
                    ]);

                    SendInternationalTalentRejectionEmail::dispatch(
                        $record->fullname,
                        $record->email,
                        $data['message']
                    );

                    Notification::make()
                        ->title(__('general.request-rejected'))
                        ->success()
                        ->send();
                }),
        ];
    }
}
