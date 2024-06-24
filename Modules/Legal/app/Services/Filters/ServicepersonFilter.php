<?php

namespace Modules\Legal\Services\Filters;

use Filament\Tables\Filters\SelectFilter;

class ServicepersonFilter
{
    public static function rank($name = 'serviceperson'): SelectFilter
    {
        return SelectFilter::make('rank')
            ->relationship("$name.rank", 'regiment_abbreviation')
            ->label('Rank')
            ->multiple()
            ->preload();
    }

    public static function battalion($name = 'serviceperson'): SelectFilter
    {
        return SelectFilter::make('battalion')
            ->relationship("$name.battalion", 'short_name')
            ->label('Battalion')
            ->multiple()
            ->preload();
    }

    public static function company($name = 'serviceperson'): SelectFilter
    {
        return SelectFilter::make('company')
            ->relationship("$name.company", 'short_name')
            ->label('Company')
            ->multiple()
            ->preload();
    }

}
