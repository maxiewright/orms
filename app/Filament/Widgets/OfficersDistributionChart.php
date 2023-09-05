<?php

namespace App\Filament\Widgets;

use App\Enums\ServiceData\BattalionEnum;
use App\Enums\ServiceData\CompanyEnum;
use App\Models\Officer;
use Illuminate\Database\Eloquent\Builder;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class OfficersDistributionChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'officersDistributionChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Officers Distribution';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => [
                $this->countOfficersByUnit(BattalionEnum::FIRST_INFANTRY, '=', CompanyEnum::REGIMENT_HEADQUARTERS),
                $this->countOfficersByUnit(BattalionEnum::FIRST_INFANTRY, '<>', CompanyEnum::REGIMENT_HEADQUARTERS),
                $this->countOfficersByUnit(BattalionEnum::SECOND_INFANTRY),
                $this->countOfficersByUnit(BattalionEnum::ENGINEERING),
                $this->countOfficersByUnit(BattalionEnum::SUPPORT_AND_SERVICE),
                $this->countOfficersByUnit(BattalionEnum::DEFENCE_FORCE_HEADQUARTERS),
            ],
            'labels' => ['RHQ', '1TTR', '2TTR', '1ENGR', 'SSB', 'DFHQ'],
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
            'colors' => [
                '#365314',
                '#22c55e',
                '#86198f',
                '#1e3a8a',
                '#ea580c',
                '#fbbf24'
            ],
        ];
    }

    protected function countOfficersByUnit($unit, $operator = null, $company = null): int
    {
        return Officer::query()
            ->where('battalion_id', $unit)
            ->when($company, fn(Builder $query) => $query
                ->where('company_id', $operator, $company))
            ->count();
    }
}
