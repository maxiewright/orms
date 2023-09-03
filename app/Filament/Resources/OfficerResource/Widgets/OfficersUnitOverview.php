<?php

namespace App\Filament\Resources\OfficerResource\Widgets;

use App\Enums\ServiceData\BattalionEnum;
use App\Enums\ServiceData\CompanyEnum;
use App\Filament\Resources\OfficerResource\Pages\ListOfficers;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OfficersUnitOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListOfficers::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('RHQ', $this->getPageTableQuery()
                ->where('company_id', CompanyEnum::REGIMENT_HEADQUARTERS)
                ->count())
                ->icon('heroicon-o-building-office-2'),
            Stat::make('1TTR', $this->getPageTableQuery()
                ->where('battalion_id', '=', BattalionEnum::FIRST_INFANTRY)
                ->where('company_id', '!=', CompanyEnum::REGIMENT_HEADQUARTERS)
                ->count())
                ->icon('heroicon-o-star'),
            Stat::make('2TTR', $this->getPageTableQuery()
                ->where('battalion_id', BattalionEnum::SECOND_INFANTRY)
                ->count())
                ->icon('heroicon-o-star'),
            Stat::make('SSB', $this->getPageTableQuery()
                ->where('battalion_id', BattalionEnum::SUPPORT_AND_SERVICE)
                ->count())
                ->icon('heroicon-o-truck'),
            Stat::make('1ENGR', $this->getPageTableQuery()
                ->where('battalion_id', BattalionEnum::ENGINEERING)
                ->count())
                ->icon('heroicon-o-home-modern'),
            Stat::make('DFHQ', $this->getPageTableQuery()
                ->where('battalion_id', BattalionEnum::DEFENCE_FORCE_HEADQUARTERS)
                ->count())
                ->icon('heroicon-o-building-office'),
        ];
    }
}
