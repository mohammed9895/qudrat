<?php

namespace App\Filament\Admin\Resources\CmsPageResource\Pages;

use App\Filament\Admin\Resources\CmsPageResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;

class CreateCmsPage extends \SolutionForest\FilamentCms\Filament\Resources\CmsPageResource\Pages\CreateCmsPage
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CmsPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
