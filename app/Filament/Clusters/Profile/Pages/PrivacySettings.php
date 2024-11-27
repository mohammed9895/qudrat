<?php

namespace App\Filament\Clusters\Profile\Pages;

use App\Filament\Clusters\Profile;
use Filament\Pages\Page;

class PrivacySettings extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-locked';

    protected static string $view = 'filament.clusters.profile.pages.privacy-settings';

    protected static ?string $cluster = Profile::class;

    protected static ?int $navigationSort = 9;
}
