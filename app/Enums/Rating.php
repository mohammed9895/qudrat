<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Rating: int implements HasColor, HasLabel
{
    case weak = 0;
    case Acceptable = 1;
    case Good = 2;
    case VeryGood = 3;
    case Excellent = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::weak => __('general.feedback.ratings.weak'),
            self::Acceptable => __('general.feedback.ratings.acceptable'),
            self::Good => __('general.feedback.ratings.good'),
            self::VeryGood => __('general.feedback.ratings.very_good'),
            self::Excellent => __('general.feedback.ratings.excellent'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::weak => 'danger',
            self::Acceptable => 'warning',
            self::Good => 'info',
            self::VeryGood => 'primary',
            self::Excellent => 'success',
        };
    }
}
