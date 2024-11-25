<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Messages extends Page
{
    protected static ?string $navigationIcon = 'hugeicons-chatting-01';

    protected static string $view = 'filament.pages.messages';

    protected static ?int $navigationSort = 3;
}
