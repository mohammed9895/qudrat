<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Profile;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MostViewedProfile extends BaseWidget
{
    protected static ?int $sort = 10;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Profile::select('profiles.*')
                    ->join('views', function ($join) {
                        $join->on('profiles.id', '=', 'views.viewable_id')
                            ->where('views.viewable_type', '=', Profile::class);
                    })
                    ->selectRaw('COUNT(views.id) as views_count')
                    ->groupBy('profiles.id')
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
