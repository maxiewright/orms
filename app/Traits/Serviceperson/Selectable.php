<?php

namespace App\Traits\Serviceperson;

use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;

trait Selectable
{
    public static function make($name = 'serviceperson_number', $relationship = 'serviceperson'): Select
    {
        return Select::make($name)
            ->relationship(name: $relationship, titleAttribute: 'number')
            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
            ->helperText('Search by number, first name, middle name or last name')
            ->searchable(['number', 'first_name', 'middle_name', 'last_name']);
    }
}
