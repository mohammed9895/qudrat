<?php

namespace App\Filament\User\Clusters\Profile\Pages;

use App\Filament\User\Clusters\Profile;
use Filament\Pages\Page;

class PrivacySettings extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-locked';

    protected static string $view = 'filament.user.clusters.profile.pages.privacy-settings';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 9;
}
