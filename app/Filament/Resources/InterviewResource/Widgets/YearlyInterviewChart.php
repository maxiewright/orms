<?php

namespace App\Filament\Resources\InterviewResource\Widgets;

use App\Enums\Interview\InterviewStatusEnum;
use App\Models\Interview;
use App\Models\Metadata\InterviewReason;
use Filament\Forms\Components\Select;
use Illuminate\Support\Arr;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class YearlyInterviewChart extends ApexChartWidget
{
    protected static ?string $chartId = 'AnnualInterviews';

    protected function getHeading(): ?string
    {
        $reason = InterviewReason::query()
            ->where('id', $this->filterFormData['interview_reason_id'])
            ->first();

        return ($reason)
            ? ucfirst($reason->name)." interviews for {$this->filterFormData['year']}"
            : "Interviews for {$this->filterFormData['year']}";
    }

    protected function getFooter(): null|string|\Illuminate\Contracts\View\View
    {
        $data = [
            'seen' => $this->getInterviewCount(InterviewStatusEnum::SEEN),
            'pending' => $this->getInterviewCount(InterviewStatusEnum::PENDING),
            'cancelled' => $this->getInterviewCount(InterviewStatusEnum::CANCELED),
        ];

        return view('filament.widgets.footer.interview-stats', ['data' => $data]);
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('interview_reason_id')
                ->label('Reason')
                ->options(InterviewReason::all()->pluck('name', 'id'))
                ->searchable(),
            Select::make('year')
                ->label('Year')
                ->options(function () {
                    $years = range(now()->year, now()->subYears(3)->year);

                    return Arr::mapWithKeys($years, fn ($value) => [
                        $value => $value,
                    ]);
                })
                ->default(now()->year),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'radialBar',
                'height' => 300,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [$this->percentOfServicepeopleSeen()],
            'plotOptions' => [
                'radialBar' => [
                    'startAngle' => -135,
                    'endAngle' => 225,
                    'hollow' => [
                        'margin' => 0,
                        'size' => '70%',
                        'dropShadow' => [
                            'enabled' => true,
                            'top' => 3,
                            'left' => 0,
                            'blur' => 4,
                            'opacity' => 0.24,
                        ],
                    ],
                    'track' => [
                        'background' => '#fff',
                        'strokeWidth' => '67%',
                        'margin' => 0,
                        'dropShadow' => [
                            'enabled' => true,
                            'top' => -3,
                            'left' => 0,
                            'blur' => 4,
                            'opacity' => 0.35,
                        ],
                    ],
                    'dataLabels' => [
                        'show' => true,
                        'name' => [
                            'show' => true,
                            'offsetY' => -10,
                            'color' => '#9ca3af',
                            'fontWeight' => 600,
                        ],
                        'value' => [
                            'show' => true,
                            'color' => '#9ca3af',
                            'fontWeight' => 600,
                        ],
                    ],

                ],
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shade' => 'dark',
                    'type' => 'horizontal',
                    'shadeIntensity' => 0.5,
                    'gradientToColors' => ['#ff0e0e'],
                    'inverseColors' => true,
                    'opacityFrom' => 1,
                    'opacityTo' => 1,
                    'stops' => [0, 100],
                ],
            ],
            'stroke' => [
                'lineCap' => 'round',
            ],
            'labels' => ['Interviewed'],
            'colors' => ['#22bb33'],

        ];
    }

    private function getInterviewCount($status = null): int
    {
        return Interview::query()
            ->whereYear('requested_at', $this->filterFormData['year'])
            ->when($status, fn ($query, $status) => $query
                ->where('interview_status_id', $status)
            )
            ->when($this->filterFormData['interview_reason_id'], fn ($query, $reason) => $query
                ->where('interview_reason_id', $reason)
            )
            ->count();
    }

    private function percentOfServicepeopleSeen(): int
    {
        $total = $this->getInterviewCount();
        $seen = $this->getInterviewCount(InterviewStatusEnum::SEEN);
        $cancelled = $this->getInterviewCount(InterviewStatusEnum::CANCELED);

        return (($total - $cancelled) !== 0)
            ? $seen / ($total - $cancelled) * 100
            : 0;
    }
}
