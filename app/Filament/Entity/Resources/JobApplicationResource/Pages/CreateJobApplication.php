<?php

namespace App\Filament\Entity\Resources\JobApplicationResource\Pages;

use App\Filament\Entity\Resources\JobApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJobApplication extends CreateRecord
{
    protected static string $resource = JobApplicationResource::class;
}
