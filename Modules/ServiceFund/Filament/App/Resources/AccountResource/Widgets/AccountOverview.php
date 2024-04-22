<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class AccountOverview extends BaseWidget
{
    public float $balance;
    public float $debits;

    public float $credits;

    protected function getStats(): array
    {
        return [
            Stat::make('Balance', Number::currency($this->balance, config('servicefund.currency'))),
            Stat::make('Debits', Number::currency($this->debits, config('servicefund.currency'))),
            Stat::make('Credits', Number::currency($this->credits, config('servicefund.currency'))),
        ];
    }
}
