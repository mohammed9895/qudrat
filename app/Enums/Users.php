<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
enum Users: int implements HasLabel
{
    case Student = 1;
    case Teacher = 2;
    case Guardian = 3;
    case Expert = 4;
    case Other = 5;

    public function getLabel(): string
    {
        return match ($this) {
            self::Student => __('general.feedback.user_types.student'),
            self::Teacher => __('general.feedback.user_types.teacher'),
            self::Guardian => __('general.feedback.user_types.guardian'),
            self::Expert => __('general.feedback.user_types.expert'),
            self::Other => __('general.feedback.user_types.other'),
        };
    }
}
