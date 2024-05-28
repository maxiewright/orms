<?php

namespace App\Filament\Pages\Dashboards;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Dashboard;

class ServicepeopleDashboard extends Dashboard
{
    use HasPageShield;

    protected static string $view = 'filament.pages.servicepeople-dashboard';

    protected function getHeaderWidgets(): array
    {
        return [

        ];
    }
}
