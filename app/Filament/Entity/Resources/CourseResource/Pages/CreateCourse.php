<?php

namespace App\Filament\Entity\Resources\CourseResource\Pages;

use App\Filament\Entity\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}
