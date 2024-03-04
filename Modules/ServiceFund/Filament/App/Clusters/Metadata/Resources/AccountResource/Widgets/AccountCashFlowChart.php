<?php

namespace Modules\ServiceFund\Filament\App\Clusters\Metadata\Resources\AccountResource\Widgets;

use Carbon\Carbon;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Collection;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\TransactionType;

class AccountCashFlowChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static ?string $chartId = 'accountCashFlowChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Cash Flow';

    public Account $account;

    private function getTransactions($type): Collection
    {
        return Trend::query(Transaction::query()
            ->where('account_id', $this->account->id)
            ->where('type', $type))
            ->dateColumn('executed_at')
            ->between(now()->subYear(), now())
            ->perMonth()
            ->sum('amount');
    }

    protected function getOptions(): array
    {

        $debits = $this->getTransactions(TransactionType::Debit);
        $credits = $this->getTransactions(TransactionType::Credit);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'stacked' => true,
            ],
            'series' => [
                [
                    'name' => 'Debits',
                    'data' => $debits->map(fn (TrendValue $value) => $value->aggregate),
                ],
                [
                    'name' => 'Credits',
                    'data' => $credits->map(fn (TrendValue $value) => (-$value->aggregate)),
                ],
            ],
            'xaxis' => [
                'categories' => $debits->map(fn (TrendValue $value) => Carbon::make($value->date)->format('M-y')),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => [
                '#00e500', // green
                '#e50000', // red
            ],
        ];
    }
}
