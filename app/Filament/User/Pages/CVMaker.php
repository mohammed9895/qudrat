<?php

namespace App\Filament\User\Pages;

use App\Models\Template;
use Filament\Forms\Form;
use Filament\Pages\Page;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;
use Spatie\Browsershot\Browsershot;

class CVMaker extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.c-v-maker';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 10;

    public array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('general.user-dashboard.navigation.cv_maker');  // Use translated label for CV Maker
    }

    public function getTitle(): string
    {
        return __('general.user-dashboard.navigation.cv_maker');  // Use translated label for CV Maker
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RadioButtonImage::make('template')
                    ->label(__('general.cvmaker.template_label'))
                    ->options(Template::all()->pluck('image', 'id')->toArray()),
            ]);
    }

    public function generate()
    {
        //        $selected_template = Template::find($this->data['template']);

        $cv_name = auth()->user()->profile->fullname.'-'.now()->format('d m Y').'XXXX.pdf';

        // Set the path to your view and the output path for the PDF
        $viewPath = 'cv-templates.template-2.index';
        $outputPath = storage_path('app/public/cvs/'.$cv_name);

        // Generate the PDF using Browsershot
        Browsershot::html(view($viewPath, ['profile' => auth()->user()->profile])->render())
            ->setOption('executablePath', '/usr/bin/google-chrome-stable')
            ->setOption('args', [
                '--no-sandbox',
                '--disable-gpu',
                '--disable-dev-shm-usage',
                '--single-process',
                '--no-zygote',
                '--user-data-dir=/tmp/chrome-profile',
                '--no-first-run',
                '--no-default-browser-check',
                '--disable-crash-reporter',
                '--no-crashpad', // Disable crashpad handler entirely
            ])
            ->setOption('viewport', ['width' => 2480, 'height' => 3508])  // Set viewport for consistent rendering
            ->margins(0, 0, 0, 0)  // Remove margins for full-page PDF
            ->save($outputPath);

        // Return the generated PDF as a download response
        return response()->download($outputPath);

    }
}
