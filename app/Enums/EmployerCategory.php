<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EmployerCategory: string implements HasColor, HasLabel
{
    case GovernmentInstitutions = 'government_institutions';
    case GovernmentCompanies = 'government_companies';
    case PrivateSector = 'private_sector';
    case Entrepreneurship = 'entrepreneurship';
    case JobSeekers = 'job_seekers';

    public function getLabel(): string
    {
        return match ($this) {
            self::GovernmentInstitutions => __('general.employer.categories.government_institutions'),
            self::GovernmentCompanies => __('general.employer.categories.government_companies'),
            self::PrivateSector => __('general.employer.categories.private_sector'),
            self::Entrepreneurship => __('general.employer.categories.entrepreneurship'),
            self::JobSeekers => __('general.employer.categories.job_seekers'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::GovernmentInstitutions => 'primary',
            self::GovernmentCompanies => 'info',
            self::PrivateSector => 'success',
            self::Entrepreneurship => 'warning',
            self::JobSeekers => 'gray',
        };
    }
}
