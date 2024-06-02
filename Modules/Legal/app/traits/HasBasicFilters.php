<?php

namespace Modules\Legal\traits;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasBasicFilters
{
    public static function getBasicFilters(): array
    {
        return [

        ];
    }
}
