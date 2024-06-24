<?php

namespace Modules\Legal\Services\Table;

use Filament\Tables\Columns\TextColumn;

class TableColumn
{
    public static function serviceperson($name = 'serviceperson.military_name'): TextColumn
    {
        return TextColumn::make($name)
            ->description(function ($record) {
                return $record->serviceperson?->battalion_and_company_short_name;
            })
            ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
            ->label('Serviceperson');
    }
}
