<?php

namespace Modules\Legal\Services\Filters;

use Filament\Tables\Filters\SelectFilter;

class TypeFilter
{
    public static function make($options): SelectFilter
    {
        return SelectFilter::make('type')
            ->label('Type')
            ->options($options)
            ->multiple()
            ->preload();

    }
}
