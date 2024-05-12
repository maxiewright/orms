<?php

namespace Modules\Legal\Filament\Pages;

use Filament\Pages\Dashboard as FilamentDashboard;
use Modules\Legal\Filament\Widgets\CourtAttendanceChart;
use Modules\Legal\Filament\Widgets\IncarcerationChart;
use Modules\Legal\Filament\Widgets\InfractionsChart;
use Modules\Legal\Filament\Widgets\InterdictionChart;
use Modules\Legal\Filament\Widgets\LegalActionsChart;
use Modules\Legal\Filament\Widgets\LegalMattersOverview;

class Dashboard extends FilamentDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static string $view = 'legal::filament.pages.dashboard';

    protected static ?string $title = 'Dashboard';

    protected static ?int $navigationSort = 2;

    public function getHeaderWidgets(): array
    {
        return [
            LegalMattersOverview::make(),
            //            InfractionsChart::make(),
            CourtAttendanceChart::make(),
            InterdictionChart::make(),
            IncarcerationChart::make(),
            LegalActionsChart::make(),
        ];
    }
}
