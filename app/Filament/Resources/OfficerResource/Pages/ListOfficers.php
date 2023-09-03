<?php

namespace App\Filament\Resources\OfficerResource\Pages;

use App\Enums\ServiceData\EmploymentStatusEnum;
use App\Filament\Resources\OfficerResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListOfficers extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = OfficerResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            OfficerResource\Widgets\OfficersUnitOverview::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|string|array
    {
        return 4;
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Available' => Tab::make()->query(fn($query) => $query
                ->where('employment_status_id', EmploymentStatusEnum::AVAILABLE)),
            'Privilege Leave' => Tab::make()->query(fn($query) => $query
                ->where('employment_status_id', EmploymentStatusEnum::PRIVILEGE_LEAVE)),
            'Sick Leave' => Tab::make()->query(fn($query) => $query
                ->where('employment_status_id', EmploymentStatusEnum::SICK_LEAVE)),
            'Local Course' => Tab::make()->query(fn($query) => $query
                ->where('employment_status_id', EmploymentStatusEnum::INTERNAL_TRAINING)),
            'In Service' => Tab::make()->query(fn($query) => $query
                ->where('employment_status_id', EmploymentStatusEnum::IN_SERVICE_TRAINING)),
            'Resettlement' => Tab::make()->query(fn($query) => $query
                ->where('employment_status_id', EmploymentStatusEnum::RESETTLEMENT_TRAINING)),
            'Absent' => Tab::make()->query(fn($query) => $query
                ->where('employment_status_id', EmploymentStatusEnum::ABSENT_WITHOUT_LEAVE)),
        ];
    }

}
