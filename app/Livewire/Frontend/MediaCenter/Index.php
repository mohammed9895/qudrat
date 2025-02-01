<?php

namespace App\Livewire\Frontend\MediaCenter;

use App\Enums\Status;
use App\Models\MediaCenterPost;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.media-center.page-title'), route('media-center.index'));
    }

    public function render()
    {
        $posts = MediaCenterPost::where('status', Status::Active)->orderBy('created_at', 'desc')->get();

        return view('livewire.frontend.media-center.index', [
            'posts' => $posts,
        ]);
    }
}
