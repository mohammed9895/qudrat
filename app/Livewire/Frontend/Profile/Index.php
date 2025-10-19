<?php

namespace App\Livewire\Frontend\Profile;

use App\Models\Profile;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use JaOcero\FilaChat\Services\ChatListService;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    public Profile $profile;

    public $rating;

    public $comment = null;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;

        if ($profile->public_profile == false && auth()->id() != $profile->user_id) {
            abort(403, 'This profile is not public.');
        }
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.navigation.social-window'), route('social-window.index'))
            ->push($this->profile->fullname, route('profile.index', $this->profile));
    }

    public function download()
    {
        // Adjust this path based on where your files are stored (e.g., storage/app/public)
        $filePath = Storage::disk('nfs')->url($this->profile->cv);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            session()->flash('error', 'File not found.');
        }
    }

    public function rate()
    {
        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $this->profile->ratings()->updateOrCreate([
            'user_id' => auth()->id(),
            'profile_id' => $this->profile->id,
        ], [
            'rating' => $this->rating,
            'comment' => $this->comment,
            'status' => 0,
        ]);

        Notification::make()
            ->title('Rating Submitted')
            ->body('Thank you for rating this profile.')
            ->send();
    }

    public function send_message()
    {
        $data = [
            'receiverable_id' => $this->profile->user_id,
            'message' => 'Hello',
        ];
        ChatListService::make()->createConversation($data);
    }

    public function render()
    {
        views($this->profile)->cooldown(now()->addMinute(10))->record();

        return view('livewire.frontend.profile.index');
    }
}
