<?php

namespace App\Filament\User\Pages;

use App\Models\Template;
use Filament\Forms\Form;
use Filament\Pages\Page;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;

class CVMaker extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.c-v-maker';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RadioButtonImage::make('template')
                    ->options(Template::all()->pluck('image', 'id')->toArray()),
            ]);
    }
}
