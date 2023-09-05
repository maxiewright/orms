<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;

use Filament\Pages\Page;

class OfficerDashboard extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Officers';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.officer-dashboard';





}
