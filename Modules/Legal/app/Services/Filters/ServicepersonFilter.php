<?php

namespace Modules\Legal\Services\Filters;

use Filament\Tables\Filters\SelectFilter;

class ServicepersonFilter
{
    public static function rank(): SelectFilter
    {
        return SelectFilter::make('rank')
            ->relationship('serviceperson.rank', 'regiment_abbreviation')
            ->label('Rank')
            ->multiple()
            ->preload();
    }

    public static function battalion(): SelectFilter
    {
        return SelectFilter::make('battalion')
            ->relationship('serviceperson.battalion', 'short_name')
            ->label('Battalion')
            ->multiple()
            ->preload();
    }

    public static function company(): SelectFilter
    {
        return SelectFilter::make('company')
            ->relationship('serviceperson.company', 'short_name')
            ->label('Company')
            ->multiple()
            ->preload();
    }

}
