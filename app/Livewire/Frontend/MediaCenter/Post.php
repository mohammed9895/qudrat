<?php

namespace App\Livewire\Frontend\MediaCenter;

use App\Enums\Status;
use App\Models\MediaCenterPost;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Post extends Component
{
    public MediaCenterPost $post;

    public $content;

    public function mount(MediaCenterPost $post)
    {
        $this->post = $post;
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Media Center', route('media-center.index'))
            ->push($this->post->title, route('media-center.post', $this->post));
    }

    public function comment()
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';
    }

    public function render()
    {
        $comments = $this->post->comments()->where('status', Status::Active)->get();
        return view('livewire.frontend.media-center.post', [
            'comments' => $comments,
        ]);
    }
}
