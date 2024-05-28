<?php

namespace Modules\Legal\Filament\Pages;

use Filament\Pages\Page;
use Modules\Legal\Filament\Widgets\CourtAppearanceCalendar;

class CourtAppearanceDocket extends Page
{

    protected static ?string $navigationGroup = 'Court Matters';

    protected static ?string $title = 'Docket';

    protected static string $view = 'legal::filament.pages.docket';

    protected static ?int $navigationSort = 1;
    protected function getHeaderWidgets(): array
    {
        return [
            CourtAppearanceCalendar::make(),
        ];

    }

}
