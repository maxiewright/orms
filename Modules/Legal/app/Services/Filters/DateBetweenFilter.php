<?php

namespace Modules\Legal\Services\Filters;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class DateBetweenFilter
{
    public static function make($name, $from, $to): Filter
    {
        return Filter::make($name)
            ->columns()
            ->columnSpan(2)
            ->form([
                DatePicker::make($from),
                DatePicker::make($to),
            ])
            ->query(function (Builder $query, array $data) use ($name, $from, $to): Builder {
                return $query
                    ->when($data[$from],
                        fn (Builder $query, $date): Builder => $query
                            ->whereDate($name, '>=', $date))
                    ->when($data[$to],
                        fn (Builder $query, $date): Builder => $query
                            ->whereDate($name, '<=', $date));
            })
            ->indicateUsing(function (array $data) use ($name, $from, $to): array {
                $indicators = [];
                $name = Str::ucfirst(explode('_', $name)[0]);

                if ($data[$from] ?? null) {
                    $indicators[$from] = $name.' from '.Carbon::parse($data[$from])->format(config('legal.date'));
                }

                if ($data[$to] ?? null) {
                    $indicators[$to] = $name.' to '.Carbon::parse($data[$to])->format(config('legal.date'));
                }

                return $indicators;
            });
    }
}
