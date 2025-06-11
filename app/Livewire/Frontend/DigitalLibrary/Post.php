<?php

namespace App\Livewire\Frontend\DigitalLibrary;

use App\Enums\Status;
use App\Models\DigitalLibraryCategory;
use App\Models\DigitalLibraryPost;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class Post extends Component
{

    public DigitalLibraryPost $post;
    public DigitalLibraryCategory $category;

    public $content;

    // public function mount(DigitalLibraryCategory $category, DigitalLibraryPost $post)
    // {
    //     $this->category = $category;
    //     $this->post = $post;
    // }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push('Digital Library', route('digital-library.index'))
            ->push($this->category->name, route('digital-library.category', $this->category))
            ->push($this->post->title, route('digital-library.post', [$this->category, $this->post]));
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
        return view('livewire.frontend.digital-library.post', [
            'comments' => $comments,
        ]);
    }
}
