<?php

namespace Modules\Legal\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LegalMattersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Infractions', 150),
            Stat::make('Ongoing Matters', 100),
            Stat::make('Interdicted', 50),
            Stat::make('Incarcerated', 100),
        ];
    }
}
