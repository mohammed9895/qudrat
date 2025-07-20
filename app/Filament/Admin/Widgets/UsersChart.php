<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersChart extends LineChartWidget
{
    protected static ?int $sort = 2;

    public ?string $filter = 'today';

    protected int|string|array $columnSpan = 'full';

    public function getHeading(): string
    {
        return 'Users';
    }

    protected function getData(): array
    {

        $activeFilter = $this->filter;

        if ($activeFilter == 'week') {
            $startDate = now()->startOfWeek()->subWeek();
            $endDate = now()->endOfWeek()->subWeek();
            $data = Trend::model(User::class)
                ->between(
                    start: $startDate,
                    end: $endDate,
                )
                ->perDay()
                ->count();
        } elseif ($activeFilter == 'today') {
            $startDate = now()->startOfDay();
            $endDate = now();
            $data = Trend::model(User::class)
                ->between(
                    start: $startDate,
                    end: $endDate,
                )
                ->perHour()
                ->count();
        } elseif ($activeFilter == 'month') {
            $startDate = now()->startOfMonth()->subMonth();
            $endDate = now()->endOfMonth()->subMonth();
            $data = Trend::model(User::class)
                ->between(
                    start: $startDate,
                    end: $endDate,
                )
                ->perDay()
                ->count();
        } else {
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
            $data = Trend::model(User::class)
                ->between(
                    start: $startDate,
                    end: $endDate,
                )
                ->perMonth()
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}
