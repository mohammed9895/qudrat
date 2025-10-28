<?php

namespace App\Livewire\Frontend\Profile;

use App\Models\Profile;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JaOcero\FilaChat\Services\ChatListService;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;
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

    public function download(): Response
    {
        $cv = $this->profile->cv; // e.g. "cvs/1234.pdf" or "public/cvs/1234.pdf" or full path or URL

        // 1) If it's a URL, just redirect to it
        if (Str::startsWith($cv, ['http://', 'https://'])) {
            return redirect()->away($cv);
        }

        // 2) Try NFS disk (if you stored it there)
        if (Storage::disk('nfs')->exists($cv)) {
            // Laravel 9+ supports ->download() directly on the disk
            return Storage::disk('nfs')->download($cv);
        }

        // 3) Try 'public' disk (common case: storage/app/public/...)
        if (Storage::disk('public')->exists($cv)) {
            return Storage::disk('public')->download($cv);
        }

        // 4) Fallback: treat it as a relative path inside storage/app
        //    (common bug: forgetting the "app/" prefix)
        $absolute = storage_path('app/'.ltrim($cv, '/'));
        if (is_file($absolute)) {
            return response()->download($absolute);
        }

        // 5) If the value was already an absolute path, try it as-is
        if (Str::startsWith($cv, ['/', '\\']) || preg_match('/^[A-Za-z]:\\\\/', $cv)) {
            if (is_file($cv)) {
                return response()->download($cv);
            }
        }

        abort(404, 'File not found');
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
