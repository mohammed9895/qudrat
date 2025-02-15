<?php

namespace App\Livewire\Frontend\MediaCenter;

use App\Enums\Status;
use App\Models\MediaCenterPost;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Index extends Component
{
    use WithPagination;

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.media-center.page-title'), route('media-center.index'));
    }

    public function render()
    {
        $posts = MediaCenterPost::where('status', Status::Active)->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.frontend.media-center.index', [
            'posts' => $posts,
        ]);
    }
}
