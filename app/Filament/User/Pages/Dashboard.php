<?php

namespace App\Filament\User\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'hugeicons-home-03';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?int $navigationSort = 1;
}
