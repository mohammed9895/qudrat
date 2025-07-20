<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Category;
use App\Models\Education;
use App\Models\Entity;
use App\Models\Interest;
use App\Models\Profile;
use App\Models\Tool;
use CyrildeWit\EloquentViewable\View;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProfilesStatsOverview extends BaseWidget
{
    protected function getHeading(): ?string
    {
        return 'Profiles Stats Overview';
    }

    protected function getStats(): array
    {

        $top_category = Category::withCount('profiles')
            ->orderByDesc('profiles_count')
            ->first();
        $top_tool = Tool::withCount('profiles')
            ->orderByDesc('profiles_count')
            ->first();
        $top_interest = Interest::withCount('profiles')
            ->orderByDesc('profiles_count')
            ->first();
        $top_degree = Education::selectRaw('education_type_id, COUNT(*) as total')
            ->groupBy('education_type_id')
            ->orderByDesc('total')
            ->first();

        return [
            BaseWidget\Stat::make('Total Profiles', Profile::count())
                ->color('primary')
                ->icon('heroicon-o-users'),
            BaseWidget\Stat::make('International Profiles', Profile::where('international_profile', true)->count())
                ->color('info')
                ->icon('heroicon-o-globe-alt'),
            BaseWidget\Stat::make('Total Profile Views', View::where('viewable_type', Profile::class)->count())
                ->color('success')
                ->icon('heroicon-o-eye'),
            BaseWidget\Stat::make('Total Entities', Entity::count())
                ->color('warning')
                ->icon('heroicon-o-briefcase'),
            BaseWidget\Stat::make('Top Categories', function () {
                return Category::withCount('profiles')
                    ->orderByDesc('profiles_count')
                    ->take(1) // or top N
                    ->first()?->name ?? 'No Data';
            })
                ->description($top_category ? "{$top_category->profiles_count} Profiles" : 'No profiles')
                ->color('danger')
                ->icon('heroicon-o-tag'),
            BaseWidget\Stat::make('Top Tool', function () {
                return Tool::withCount('profiles')
                    ->orderByDesc('profiles_count')
                    ->take(1) // or top N
                    ->first()?->name ?? 'No Data';
            })
                ->description($top_tool ? "{$top_tool->profiles_count} Profiles" : 'No profiles')
                ->color('danger')
                ->icon('heroicon-o-tag'),
            BaseWidget\Stat::make('Top Interest', function () {
                return Interest::withCount('profiles')
                    ->orderByDesc('profiles_count')
                    ->take(1) // or top N
                    ->first()?->name ?? 'No Data';
            })
                ->description($top_interest ? "{$top_interest->profiles_count} Profiles" : 'No profiles')
                ->color('danger')
                ->icon('heroicon-o-tag'),
            BaseWidget\Stat::make('Top Degree Used', function () {
                return Education::select('education_type_id')
                    ->groupBy('education_type_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->limit(1)
                    ->pluck('education_type_id')
                    ->first() ?? 'No Data';
            })
                ->description($top_degree ? "{$top_degree->total} Profiles" : 'No profiles')
                ->color('warning')
                ->icon('heroicon-o-academic-cap'),
        ];
    }
}
