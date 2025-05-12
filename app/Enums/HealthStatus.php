<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum HealthStatus: int implements HasColor, HasLabel
{
    case Healthy = 1;
    case UnHealthy = 0;

    public function getLabel(): string
    {
        return match ($this) {
            self::Healthy => __('general.health_status.healthy'),
            self::UnHealthy =>  __('general.health_status.unhealthy'),
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Healthy => 'success',
            self::UnHealthy => 'danger',
        };
    }
}
