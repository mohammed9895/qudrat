<?php

namespace App\Filament\User\Clusters;

use Filament\Actions\Action;
use Filament\Actions\LocaleSwitcher;
use Filament\Clusters\Cluster;

class Profile extends Cluster
{
    protected static ?string $navigationIcon = 'hugeicons-profile-02';

    protected static ?int $navigationSort =2;

}
