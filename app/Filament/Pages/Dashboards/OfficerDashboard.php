<?php

namespace App\Filament\Pages\Dashboards;

use App\Filament\Widgets\OfficersDispositionChart;
use App\Filament\Widgets\OfficersDistributionChart;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Dashboard;

class OfficerDashboard extends Dashboard
{
    use HasPageShield;

    protected static string $routePath = 'officers/dashboard';

    protected static ?string $title = 'Officers Dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Officers';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.officer-dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            OfficersDistributionChart::make(),
            OfficersDispositionChart::make(),
        ];
    }
}
