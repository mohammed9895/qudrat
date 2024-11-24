<?php

namespace App\Filament\Clusters\Profile\Pages;

use App\Filament\Clusters\Profile;
use Filament\Pages\Page;

class Certificates extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.profile.pages.certificates';

    protected static ?string $cluster = Profile::class;
}
