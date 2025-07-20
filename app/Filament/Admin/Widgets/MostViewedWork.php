<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Profile;
use App\Models\Work;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MostViewedWork extends BaseWidget
{
    protected static ?int $sort = 11;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Work::select('works.*')
                    ->join('views', function ($join) {
                        $join->on('works.id', '=', 'views.viewable_id')
                            ->where('views.viewable_type', '=', Work::class);
                    })
                    ->selectRaw('COUNT(views.id) as views_count')
                    ->groupBy('works.id')
                    ->orderByDesc('views_count')
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('fullname')
                    ->label('Profile')
                    ->searchable(),
                TextColumn::make('views_count')
                    ->label('Views')
                    ->badge()
                    ->getStateUsing(fn (Profile $record) => views($record)->count()),
            ]);
    }
}
