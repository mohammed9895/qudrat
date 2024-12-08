<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Status: int implements HasLabel, HasColor
{
    case Active = 1;
    case Inactive = 0;

    public function getLabel(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'danger',
        };
    }
}
