<?php

namespace Modules\Legal\Services\Filters;

use Filament\Tables\Filters\SelectFilter;

class StatusFilter
{
    public static function make($options): SelectFilter
    {
        return SelectFilter::make('status')
            ->label('Status')
            ->options($options)
            ->multiple()
            ->preload();
    }
}
