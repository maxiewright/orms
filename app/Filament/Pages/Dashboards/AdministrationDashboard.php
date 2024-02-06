<?php

namespace App\Filament\Pages\Dashboards;

use App\Filament\Resources\InterviewResource\Widgets\MonthlyInterviewChart;
use App\Filament\Resources\InterviewResource\Widgets\YearlyInterviewChart;
use App\Filament\Widgets\AdministrationOverview;
use Filament\Pages\Dashboard;

class AdministrationDashboard extends Dashboard
{
    protected static string $routePath = 'administration/dashboard';

    protected static ?string $title = 'Administration Dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.administration-dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            //            AdministrationOverview::make(),
            YearlyInterviewChart::make(),
            MonthlyInterviewChart::make(),
        ];
    }
}
