<?php

namespace App\Livewire\Frontend\DigitalLibrary;

use App\Enums\Status;
use App\Models\DigitalLibraryCategory;
use App\Models\DigitalLibraryPost;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Attributes\Computed;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class ListPosts extends Component implements HasForms
{
    use InteractsWithForms;

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
        $options = DigitalLibraryCategory::withCount('digitalLibraryposts')->get()->mapWithKeys(function ($category) {
            return [$category->id => "{$category->name} ({$category->posts_count})"];
        });

        return $form->schema([
            TextInput::make('search')
                ->label(__('general.search'))
                ->placeholder(__('general.search-placeholder'))
                ->live(onBlur: true)
                ->columnSpanFull(),
            CheckboxList::make('categoriesList')
                ->label(__('general.category'))
                ->options(
                    DigitalLibraryCategory::whereHas('digitalLibraryposts')->pluck('name', 'id')
                )
                ->live()
                ->searchable()
                ->columnSpanFull(),
        ])->statePath('data');
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('general.digital-library.main-title'), route('digital-library.index'));
    }

    #[Computed]
    public function posts()
    {
        return DigitalLibraryPost::query()
            ->where('status', Status::Active)
            ->when(! empty($this->data['categoriesList']), function ($query) {
                $query->whereIn('digital_library_category_id', $this->data['categoriesList']);
            })
            ->when(! empty($this->data['search']), function ($query) {
                $query->where('title', 'like', '%'.$this->data['search'].'%');
            })
            ->with('digitalLibraryCategory') // optional: eager load category
            ->orderBy('created_at', $this->orderDirection) // optional: order by latest post
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.frontend.digital-library.list-posts');
    }
}
