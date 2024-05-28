<?php

namespace Modules\Legal\Filament\Clusters\CourtMatters\Resources\ReleaseConditionResource\Pages;

use Modules\Legal\Filament\Clusters\CourtMatters\Resources\ReleaseConditionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageReleaseConditions extends ManageRecords
{
    protected static string $resource = ReleaseConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
