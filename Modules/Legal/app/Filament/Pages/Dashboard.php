<?php

namespace Modules\Legal\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Dashboard as FilamentDashboard;

class Dashboard extends FilamentDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'legal::filament.pages.dashboard';
}
