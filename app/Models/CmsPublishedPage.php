<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class CmsPublishedPage extends \SolutionForest\FilamentCms\Models\CmsPublishedPage
{
    use HasTranslations;

    // public const HOME_SLUG = 'home';

    public $translatable = [
        'title',
        'data',
    ];
}
