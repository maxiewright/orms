<?php

namespace Modules\Legal\Filament\Widgets;

use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Filament\Resources\CourtAppearanceResource;
use Modules\Legal\Models\CourtAppearance;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CourtAppearanceCalendar extends FullCalendarWidget
{
    public string|null|Model $model = CourtAppearance::class;

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridWeek,dayGridDay',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }

    public function fetchEvents(array $info): array
    {

        return CourtAppearance::query()
            ->where('next_date', '>=', $info['start'])
            ->get()
            ->map(
                fn (CourtAppearance $event) => EventData::make()
                    ->title('hello')
                    ->start($event->next_date)
                    ->url(
                        url: CourtAppearanceResource::getUrl(
                            name: 'view',
                            parameters: ['record' => $event]),
                        shouldOpenUrlInNewTab: true
                    )
            )
            ->all();

    }
}
