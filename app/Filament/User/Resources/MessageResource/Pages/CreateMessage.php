<?php

namespace App\Filament\User\Resources\MessageResource\Pages;

use App\Filament\User\Resources\MessageResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;

    public function afterCreate(): void
    {
        $this->getRecord()->messages()->create([
            'sender_id' => auth()->id(),
            'content' => $this->data['messages']['content'],
        ]);

        Notification::make()
            ->title(__('general.new-message'))
            ->sendToDatabase(User::find($this->data['receiver_id']));
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['creator_id'] = auth()->id();

        return $data;
    }
}
