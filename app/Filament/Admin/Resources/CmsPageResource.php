<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CmsPageResource\Pages;
use Filament\Resources\Concerns\Translatable;

class CmsPageResource extends \SolutionForest\FilamentCms\Filament\Resources\CmsPageResource
{
    use Translatable;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCmsPages::route('/'),
            'create' => Pages\CreateCmsPage::route('/create'),
            'edit' => Pages\EditCmsPage::route('/{record}/edit'),
        ];
    }
}
