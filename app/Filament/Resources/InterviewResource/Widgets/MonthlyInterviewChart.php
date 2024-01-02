<?php

namespace App\Filament\Resources\InterviewResource\Widgets;

use App\Enums\Interview\InterviewStatusEnum;
use App\Models\Interview;
use App\Models\Metadata\InterviewReason;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class MonthlyInterviewChart extends ApexChartWidget
{

    protected static string $chartId = 'monthlyInterviewChart';

    protected function getHeading(): ?string
    {
        $start = Carbon::make( $this->filterFormData['start_at'])->format('M y');
        $end = Carbon::make( $this->filterFormData['end_at'])->format('M y');

        $reason = InterviewReason::query()
            ->where('id', $this->filterFormData['interview_reason_id'])
            ->first();

        return ($reason)
            ? ucfirst($reason->name) . " interviews for the period $start to $end"
            : "Interviews for the period $start to $end";
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('interview_reason_id')
                ->label('Reason')
                ->options(InterviewReason::all()->pluck('name', 'id'))
                ->searchable(),
            DatePicker::make('start_at')
                ->default(now()->startOfYear()),
            DatePicker::make('end_at')
                ->default(now()),
        ];
    }
    protected function getOptions(): array
    {

        $data = $this->interviewData();
        $seen = $this->interviewData(InterviewStatusEnum::SEEN);
        $pending = $this->interviewData(InterviewStatusEnum::PENDING);
        $cancelled = $this->interviewData(InterviewStatusEnum::CANCELED);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'stacked' => true,
            ],
            'series' => [
                [
                    'name' => 'Seen',
                    'data' => $seen->map(fn (TrendValue $value) => $value->aggregate),
                ],
                [
                    'name' => 'Pending',
                    'data' => $pending->map(fn (TrendValue $value) => $value->aggregate),
                ],
                [
                    'name' => 'Cancelled',
                    'data' => $cancelled->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'xaxis' => [
                'categories' => $data->map(fn (TrendValue $value) => Carbon::make($value->date)->format('M')),
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
                '#22bb33',
                '#ff0e0e',
                '#aaaaaa',
            ],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                ],
            ],
        ];
    }

    private function interviewData($status = null): Collection
    {
        return Trend::query(Interview::query()
            ->when($status, fn ($query, $status) => $query
                ->where('interview_status_id', $status))
            ->when($this->filterFormData['interview_reason_id'], fn ($query, $filter) => $query
                ->where('interview_reason_id', $filter)))
            ->dateColumn('requested_at')
            ->between(
                start: Carbon::parse( $this->filterFormData['start_at']),
                end: Carbon::parse( $this->filterFormData['end_at']),
            )
            ->perMonth()
            ->count();
    }
}
