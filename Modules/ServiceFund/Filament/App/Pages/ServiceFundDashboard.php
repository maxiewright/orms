<?php

namespace Modules\ServiceFund\Filament\App\Pages;

use Filament\Pages\Dashboard;

class ServiceFundDashboard extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?int $navigationSort = -1;
    protected static string $routePath = 'dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $title = 'Service Funds Dashboard';
}
