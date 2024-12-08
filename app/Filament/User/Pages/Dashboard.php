<?php

namespace App\Filament\User\Pages;

use RalphJSmit\Filament\Onboard\Widgets\OnboardTrackWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'hugeicons-home-03';

    protected static string $view = 'filament.user.pages.dashboard';

    protected static ?int $navigationSort = 1;

    protected function getHeaderWidgets(): array
    {
        return [
            OnboardTrackWidget::class,
        ];
    }
}
