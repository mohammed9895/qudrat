<?php

namespace App\Filament\Entity\Pages;

use Filament\Pages\Page;

class AddCertificateForUser extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.entity.pages.add-certificate-for-user';

    public $data = [];

}
