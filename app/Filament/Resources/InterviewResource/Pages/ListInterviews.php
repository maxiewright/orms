<?php

namespace App\Filament\Resources\InterviewResource\Pages;

use App\Enums\Interview\InterviewReasonEnum;
use App\Filament\Resources\InterviewResource;
use App\Filament\Resources\InterviewResource\Widgets\InterviewStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListInterviews extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = InterviewResource::class;

    protected function getTableFiltersFormColumns(): int|array
    {
        return 4;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            InterviewStatsWidget::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'performance' => Tab::make()->query(fn ($query) => $query
                ->where('interview_reason_id', InterviewReasonEnum::PERFORMANCE)),
            'welfare' => Tab::make()->query(fn ($query) => $query
                ->where('interview_reason_id', InterviewReasonEnum::WELFARE)),
            'interdiction' => Tab::make()->query(fn ($query) => $query
                ->where('interview_reason_id', InterviewReasonEnum::INTERDICTION)),
            'promotion' => Tab::make()->query(fn ($query) => $query
                ->where('interview_reason_id', InterviewReasonEnum::PROMOTION)),
            'seniority' => Tab::make()->query(fn ($query) => $query
                ->where('interview_reason_id', InterviewReasonEnum::SENIORITY)),
            'personal matter' => Tab::make()->query(fn ($query) => $query
                ->where('interview_reason_id', InterviewReasonEnum::PERSONAL_MATTER)),
            'redress' => Tab::make()->query(fn ($query) => $query
                ->where('interview_reason_id', InterviewReasonEnum::REDRESS)),
        ];
    }
}
