<?php

namespace App\Filament\Admin\Resources\CmsPageResource\Pages;

use App\Filament\Admin\Resources\CmsPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class ListCmsPages extends \SolutionForest\FilamentCms\Filament\Resources\CmsPageResource\Pages\ListCmsPages
{
    use Translatable;

    protected static string $resource = CmsPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
