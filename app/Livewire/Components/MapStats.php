<?php

namespace App\Livewire\Components;

use App\Models\Profile;
use Livewire\Component;

class MapStats extends Component
{
    public $mapData;

    public function mount()
    {
        $this->mapData = Profile::selectRaw('international_profile as code, COUNT(*) as count')
            ->groupBy('international_profile')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->code => [
                        'active' => [
                            'value' => $item->count,
                            'percent' => '0', // You can calculate this if needed
                            'isGrown' => true, // You can customize this logic
                        ],
                        'new' => [
                            'value' => rand(10, 100), // Example
                            'percent' => '0',
                            'isGrown' => true,
                        ],
                        'fillKey' => 'MAJOR',
                        'short' => strtolower(substr($item->code, 0, 2)), // e.g. 'us'
                    ],
                ];
            })->toArray();
    }

    public function render()
    {
        return view('livewire.components.map-stats');
    }
}
