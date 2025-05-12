<?php

namespace App\Filament\User\Clusters;

use Filament\Actions\Action;
use Filament\Actions\LocaleSwitcher;
use Filament\Clusters\Cluster;
use Illuminate\Contracts\Support\Htmlable;

class Profile extends Cluster
{
    protected static ?string $navigationIcon = 'hugeicons-profile-02';

    protected static ?int $navigationSort =2;

    public static function getNavigationLabel(): string
    {
        return __('general.user-dashboard.navigation.profile');
    }
    public static function getClusterBreadcrumb(): string
    {
        return __('general.user-dashboard.navigation.profile');
    }

}
