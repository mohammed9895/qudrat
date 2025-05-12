<?php

namespace App\Livewire\Frontend\Work;

use App\Models\Work;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiter;

class Show extends Component
{
    public Work $work;
    public $liked = false;
    public $likesCount = 0;

    public function mount(Work $work)
    {
        $this->work = $work;
        $this->updateLikeState();
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.works'), route('works.index'))
            ->push($this->work->title, route('works.show', $this->work));
    }

    #[On('download-attachment')]
    public function downloadAttachment($attachment)
    {
        dd($attachment);

        return response()->download(storage_path($attachment));
    }

    public function toggleLike()
    {
        if (!Auth::check()) return;

        // $key = 'like-toggle:' . Auth::id() . ':' . $this->modelType . ':' . $this->modelId;

        // $rateLimiter = app(RateLimiter::class);

        $like = Like::where('user_id', Auth::id())
            ->where('likeable_type', Work::class)
            ->where('likeable_id', $this->work->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'likeable_type' => Work::class,
                'likeable_id' => $this->work->id,
            ]);
        }

        $this->updateLikeState();
    }

    public function updateLikeState()
    {
        $this->likesCount = Like::where('likeable_type', Work::class)
            ->where('likeable_id', $this->work->id)
            ->count();

        $this->liked = Like::where('likeable_type', Work::class)
            ->where('likeable_id', $this->work->id)
            ->where('user_id', Auth::id())
            ->exists();
    }

    public function render()
    {
        return view('livewire.frontend.work.show');
    }
}
