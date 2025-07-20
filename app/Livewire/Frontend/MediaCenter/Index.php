<?php

namespace App\Livewire\Frontend\MediaCenter;

use App\Enums\Status;
use App\Models\MediaCenterPost;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Index extends Component implements HasForms
{
    use InteractsWithForms, WithPagination;

    public ?array $data = [];

    public string $viewMode = 'grid'; // Options: 'grid' or 'list'

    public string $orderDirection = 'desc'; // or 'asc'

    public function mount()
    {
        $this->form->fill();
    }

    public function toggleOrderDirection()
    {
        $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('search')
                ->label(__('general.search'))
                ->placeholder(__('general.search-placeholder'))
                ->live(onBlur: true),
        ])->statePath('data');
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.media-center.page-title'), route('media-center.index'));
    }

    #[Computed]
    public function posts()
    {
        return MediaCenterPost::query()
            ->where('status', Status::Active)
            ->when($this->data['search'] ?? null, function ($query) {
                $search = '%'.$this->data['search'].'%';

                $query->where(function ($q) use ($search) {
                    $q->where('title->ar', 'like', $search)
                        ->orWhere('title->en', 'like', $search)
                        ->orWhere('content->ar', 'like', $search)
                        ->orWhere('content->en', 'like', $search);
                });
            })
            ->orderBy('created_at', $this->orderDirection)
            ->paginate(12);
    }

    public function render()
    {

        return view('livewire.frontend.media-center.index');
    }
}
