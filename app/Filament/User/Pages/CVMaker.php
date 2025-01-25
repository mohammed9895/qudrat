<?php

namespace App\Filament\User\Pages;

use App\Models\Template;
use Filament\Forms\Form;
use Filament\Pages\Page;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;
use Spatie\LaravelPdf\Facades\Pdf;

class CVMaker extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.c-v-maker';

    public array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RadioButtonImage::make('template')
                    ->options(Template::all()->pluck('image', 'id')->toArray()),
            ]);
    }

    public function generate()
    {
        //        $selected_template = Template::find($this->data['template']);

        $cv_name = auth()->user()->profile->fullname.'-'.now()->format('d m Y').'XXXX.pdf';

        Pdf::view('cv-templates.template-1.index', ['profile' => auth()->user()->profile])
            ->margins(0, 0, 0, 0)
            ->save(storage_path('app/public/cvs/'.$cv_name));

        // download the generated pdf
        return response()->download(storage_path('app/public/cvs/'.$cv_name));

    }
}
