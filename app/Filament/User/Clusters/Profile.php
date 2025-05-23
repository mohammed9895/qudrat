<?php

namespace App\Filament\User\Clusters;

use Filament\Clusters\Cluster;

class Profile extends Cluster
{
    protected static ?string $navigationIcon = 'hugeicons-profile-02';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('general.user-dashboard.navigation.profile');
    }

    public static function getClusterBreadcrumb(): string
    {
        return __('general.user-dashboard.navigation.profile');
    }
}
