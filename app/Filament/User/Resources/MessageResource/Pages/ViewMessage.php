<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\User\Resources\MessageResource;
use App\Models\Topic;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

/** @property Topic $record */
class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    //    public function getTitle(): string|Htmlable
    //    {
    //        __('general.message-resource.view_conversation');
    //    }

    public function mount(int|string $record): void
    {
        parent::mount($record);

        $this->record->markMessagesAsRead();
    }

    public function getSubheading(): ?string
    {
        return __('general.message-resource.subject_prefix').$this->record->subject;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('reply')
                ->label(__('general.message-resource.reply'))
                ->form([
                    Textarea::make('content')
                        ->required(),
                ])
                ->action(function (Topic $record, array $data): void {
                    $record->messages()->create([
                        'sender_id' => auth()->id(),
                        'content' => $data['content'],
                    ]);

                    Notification::make()
                        ->title('New Reply To '.$record->subject)
                        ->sendToDatabase(User::find($record['receiver_id']));
                }),
        ];
    }
}
