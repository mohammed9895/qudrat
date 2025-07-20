<?php

namespace App\Filament\Admin\Resources\EntityResource\Pages;

use App\Filament\Admin\Resources\EntityResource;
use App\Jobs\SendEntityCreatedEmail;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEntity extends CreateRecord
{
    protected static string $resource = EntityResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        SendEntityCreatedEmail::dispatch($data['name'], $data['email'], '12345678');

        $user = User::find($data['user_id']);

        $user->assignRole('entity');

        return static::getModel()::create($data);
    }
}
