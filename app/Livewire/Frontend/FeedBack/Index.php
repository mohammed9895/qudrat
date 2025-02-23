<?php

namespace App\Livewire\Frontend\FeedBack;

use App\Enums\Rating;
use App\Enums\Users;
use App\Models\Feedback;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Index extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.feedback.main-title'), route('feedbacks.index'));
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    ToggleButtons::make('user_type')
                        ->label(__('general.feedback.user_type'))
                        ->options(Users::class)->inline(),
                    ToggleButtons::make('general_impression')
                        ->label(__('general.feedback.general_impression'))
                        ->options(Rating::class)->inline(),
                    ToggleButtons::make('ease')
                        ->label(__('general.feedback.ease'))
                        ->options(Rating::class)->inline(),
                    ToggleButtons::make('speed')
                        ->label(__('general.feedback.speed'))
                        ->options(Rating::class)->inline(),
                    ToggleButtons::make('meet_your_needs')
                        ->label(__('general.feedback.meet_your_needs'))
                        ->options(Rating::class)->inline(),
                    ToggleButtons::make('clarity')
                        ->label(__('general.feedback.clarity'))
                        ->options(Rating::class)->inline(),
                    RichEditor::make('comment')
                        ->label(__('general.feedback.comment')),
                    TextInput::make('phone_number')
                        ->label(__('general.feedback.phone_number'))
                        ->tel()
                        ->prefix('+968')
                        ->required(),
                ]),
            ])
            ->statePath('data');
    }

    public function create()
    {

        $executed = RateLimiter::attempt(
            'send-feedback:'.request()->ip(),
            $perMinute = 1,
            function () {
                Feedback::create($this->data);

                return Notification::make()
                    ->title('Saved successfully')
                    ->success()
                    ->send();
            }
        );

        if (! $executed) {
            return Notification::make()
                ->title('You are sending feedback too frequently')
                ->danger()
                ->send();
        }

        $this->reset('data');

    }

    public function render()
    {
        return view('livewire.frontend.feed-back.index');
    }
}
