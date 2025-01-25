<?php

namespace App\Models;

use SolutionForest\FilamentCms\Models\CmsPage as BaseModel;
use Spatie\Translatable\HasTranslations;

class CmsPage extends BaseModel
{
    use HasTranslations;

    public $translatable = [
        'title',
        'data',
    ];
}
