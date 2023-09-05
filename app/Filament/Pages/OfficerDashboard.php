<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OfficersDispositionChart;
use Filament\Pages\Dashboard;

use Filament\Pages\Page;

class OfficerDashboard extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Officers';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.officer-dashboard';

    public function getHeaderWidgetsColumns(): int|string|array
    {
        return 1;
    }

    protected function getHeaderWidgets(): array
    {
        return [
          OfficersDispositionChart::make(),
        ];
    }


}
