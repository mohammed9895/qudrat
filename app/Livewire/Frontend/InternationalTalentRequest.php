<?php

namespace App\Livewire\Frontend;

use App\Models\Country;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class InternationalTalentRequest extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        // Initialize the form state if needed
        $this->form->fill();
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.international-talent-request.title'), route('international-talent-requests.index'));
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('general.international-talent-request.title'))
                ->description(__('general.international-talent-request.description'))
                ->columns(1)
                ->schema([
                    // Define the form fields here
                    TextInput::make('fullname')
                        ->label(__('general.fullname'))
                        ->required(),
                    TextInput::make('email')
                        ->label(__('general.email'))
                        ->email()
                        ->required(),
                    TextInput::make('phone')
                        ->label(__('general.phone')),
                    DatePicker::make('dob')
                        ->native(false)
                        ->label(__('general.dob')),
                    Select::make('country')
                        ->options(Country::orderBy('name', 'desc')->pluck('name', 'id'))
                        ->searchable()
                        ->columnSpanFull()
                        ->label(__('general.country')),
                    RichEditor::make('bio')
                        ->columnSpanFull()
                        ->label(__('general.bio'))
                        ->required(),
                    FileUpload::make('cv')
                        ->label(__('general.cv'))
                        ->acceptedFileTypes(['application/pdf'])
                        ->required(),
                    FileUpload::make('portfolio')
                        ->acceptedFileTypes(['application/pdf'])
                        ->label(__('general.portfolio')),
                    TextInput::make('linkedin')
                        ->label(__('general.linkedin')),
                    TextInput::make('github')
                        ->label(__('general.github')),
                    TextInput::make('twitter')
                        ->label(__('general.twitter')),
                    TextInput::make('website')
                        ->label(__('general.website')),
                ])->columns(2),
        ])->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState();

        \App\Models\InternationalTalentRequest::create($data);

        Notification::make()
            ->title(__('general.international-talent-request.success'))
            ->body(__('general.international-talent-request.submission-success'))
            ->success()
            ->send();
        // Reset the form after submission
        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.frontend.international-talent-request');
    }
}
