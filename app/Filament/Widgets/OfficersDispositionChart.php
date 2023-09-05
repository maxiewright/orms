<?php

namespace App\Filament\Widgets;

use App\Enums\ServiceData\BattalionEnum;
use App\Enums\ServiceData\CompanyEnum;
use App\Enums\ServiceData\EmploymentStatusEnum;
use App\Filament\Resources\OfficerResource\Pages\ListOfficers;
use App\Models\Officer;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Database\Eloquent\Builder;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class OfficersDispositionChart extends ApexChartWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListOfficers::class;
    }

    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'officersDispositionChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Officers Disposition';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $rhq = Officer::query()
            ->where('company_id', CompanyEnum::REGIMENT_HEADQUARTERS);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 500,
                'stacked' => true
            ],
            'series' => [
                [
                    'name' => 'RHQ',
                    'data' => [
                        $this->rhq(EmploymentStatusEnum::AVAILABLE),
                        $this->rhq(EmploymentStatusEnum::PRIVILEGE_LEAVE),
                        $this->rhq(EmploymentStatusEnum::SICK_LEAVE),
                        $this->rhq(EmploymentStatusEnum::RESETTLEMENT_TRAINING),
                        $this->rhq(EmploymentStatusEnum::FOREIGN_MILITARY_TRAINING),
                        $this->rhq(EmploymentStatusEnum::IN_SERVICE_TRAINING),
                        $this->rhq(EmploymentStatusEnum::INTERNAL_TRAINING),
                        $this->rhq(EmploymentStatusEnum::ABSENT_WITHOUT_LEAVE),
                    ],
                ],
                [
                    'name' => '1TTR',
                    'data' => [
                        $this->firstBn(EmploymentStatusEnum::AVAILABLE),
                        $this->firstBn(EmploymentStatusEnum::PRIVILEGE_LEAVE),
                        $this->firstBn(EmploymentStatusEnum::SICK_LEAVE),
                        $this->firstBn(EmploymentStatusEnum::RESETTLEMENT_TRAINING),
                        $this->firstBn(EmploymentStatusEnum::FOREIGN_MILITARY_TRAINING),
                        $this->firstBn(EmploymentStatusEnum::IN_SERVICE_TRAINING),
                        $this->firstBn(EmploymentStatusEnum::INTERNAL_TRAINING),
                        $this->firstBn(EmploymentStatusEnum::ABSENT_WITHOUT_LEAVE),
                    ],
                ],
                [
                    'name' => '2TTR',
                    'data' => [
                        $this->secondBn(EmploymentStatusEnum::AVAILABLE),
                        $this->secondBn(EmploymentStatusEnum::PRIVILEGE_LEAVE),
                        $this->secondBn(EmploymentStatusEnum::SICK_LEAVE),
                        $this->secondBn(EmploymentStatusEnum::RESETTLEMENT_TRAINING),
                        $this->secondBn(EmploymentStatusEnum::FOREIGN_MILITARY_TRAINING),
                        $this->secondBn(EmploymentStatusEnum::IN_SERVICE_TRAINING),
                        $this->secondBn(EmploymentStatusEnum::INTERNAL_TRAINING),
                        $this->secondBn(EmploymentStatusEnum::ABSENT_WITHOUT_LEAVE),
                    ],
                ],
                [
                    'name' => '1ENGR',
                    'data' => [
                        $this->engr(EmploymentStatusEnum::AVAILABLE),
                        $this->engr(EmploymentStatusEnum::PRIVILEGE_LEAVE),
                        $this->engr(EmploymentStatusEnum::SICK_LEAVE),
                        $this->engr(EmploymentStatusEnum::RESETTLEMENT_TRAINING),
                        $this->engr(EmploymentStatusEnum::FOREIGN_MILITARY_TRAINING),
                        $this->engr(EmploymentStatusEnum::IN_SERVICE_TRAINING),
                        $this->engr(EmploymentStatusEnum::INTERNAL_TRAINING),
                        $this->engr(EmploymentStatusEnum::ABSENT_WITHOUT_LEAVE),
                    ],
                ],
                [
                    'name' => 'SSB',
                    'data' => [
                        $this->ssb(EmploymentStatusEnum::AVAILABLE),
                        $this->ssb(EmploymentStatusEnum::PRIVILEGE_LEAVE),
                        $this->ssb(EmploymentStatusEnum::SICK_LEAVE),
                        $this->ssb(EmploymentStatusEnum::RESETTLEMENT_TRAINING),
                        $this->ssb(EmploymentStatusEnum::FOREIGN_MILITARY_TRAINING),
                        $this->ssb(EmploymentStatusEnum::IN_SERVICE_TRAINING),
                        $this->ssb(EmploymentStatusEnum::INTERNAL_TRAINING),
                        $this->ssb(EmploymentStatusEnum::ABSENT_WITHOUT_LEAVE),
                    ],
                ],
                [
                    'name' => 'DFHQ',
                    'data' => [
                        $this->dfhq(EmploymentStatusEnum::AVAILABLE),
                        $this->dfhq(EmploymentStatusEnum::PRIVILEGE_LEAVE),
                        $this->dfhq(EmploymentStatusEnum::SICK_LEAVE),
                        $this->dfhq(EmploymentStatusEnum::RESETTLEMENT_TRAINING),
                        $this->dfhq(EmploymentStatusEnum::FOREIGN_MILITARY_TRAINING),
                        $this->dfhq(EmploymentStatusEnum::IN_SERVICE_TRAINING),
                        $this->dfhq(EmploymentStatusEnum::INTERNAL_TRAINING),
                        $this->dfhq(EmploymentStatusEnum::ABSENT_WITHOUT_LEAVE),
                    ],
                ],
            ],
            'xaxis' => [
                'categories' => [
                    'Available',
                    'P/L',
                    'S/L',
                    'R/Trg',
                    'F/Trg',
                    'In Service',
                    'L/Trg',
                    'Abs',
                ],
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
                '#365314',
                '#22c55e',
                '#86198f',
                '#1e3a8a',
                '#ea580c',
                '#fbbf24'
            ],
        ];
    }


    protected function countOfficersByStatusAndUnit($status, $unit, $operator = null, $company = null): int
    {
        return Officer::query()
            ->where('employment_status_id', $status)
            ->where('battalion_id', $unit)
            ->when($company, fn(Builder $query) => $query
                ->where('company_id', $operator, $company))
            ->count();
    }

    public function rhq($status): int
    {
        return $this->countOfficersByStatusAndUnit(
            $status,
            BattalionEnum::FIRST_INFANTRY,
            '=',
            CompanyEnum::REGIMENT_HEADQUARTERS,
        );
    }

    public function firstBn($status): int
    {
        return $this->countOfficersByStatusAndUnit(
            $status,
            BattalionEnum::FIRST_INFANTRY,
            '<>',
            CompanyEnum::REGIMENT_HEADQUARTERS,
        );
    }

    public function secondBn($status): int
    {
        return $this->countOfficersByStatusAndUnit(
            $status, BattalionEnum::SECOND_INFANTRY,
        );
    }

    public function engr($status): int
    {
        return $this->countOfficersByStatusAndUnit(
            $status, BattalionEnum::ENGINEERING,
        );
    }

    public function ssb($status): int
    {
        return $this->countOfficersByStatusAndUnit(
            $status, BattalionEnum::SUPPORT_AND_SERVICE,
        );
    }

    public function dfhq($status): int
    {
        return $this->countOfficersByStatusAndUnit(
            $status, BattalionEnum::DEFENCE_FORCE_HEADQUARTERS,
        );
    }
}
