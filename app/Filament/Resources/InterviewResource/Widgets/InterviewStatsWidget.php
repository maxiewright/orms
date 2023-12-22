<?php

namespace App\Filament\Resources\InterviewResource\Widgets;

use App\Enums\Interview\InterviewStatusEnum;
use App\Filament\Resources\InterviewResource\Pages\ListInterviews;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InterviewStatsWidget extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListInterviews::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Pending', $this->getPageTableQuery()
                ->where('interview_status_id', InterviewStatusEnum::PENDING)
                ->count())
                ->icon('heroicon-o-eye-slash'),
            Stat::make('Seen', $this->getPageTableQuery()
                ->where('interview_status_id', InterviewStatusEnum::SEEN)
                ->count())
                ->icon('heroicon-o-eye'),
            Stat::make('Canceled', $this->getPageTableQuery()
                ->where('interview_status_id', InterviewStatusEnum::CANCELED)
                ->count())
                ->icon('heroicon-o-x-mark'),
        ];
    }
}
