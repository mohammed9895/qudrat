<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ExpertRequestStatus: int implements HasColor, HasLabel
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => __('general.expert_request_status.pending'),
            self::Approved => __('general.expert_request_status.approved'),
            self::Rejected => __('general.expert_request_status.rejected'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }
}
