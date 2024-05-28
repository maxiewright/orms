<?php

namespace Modules\Legal\Filament\Clusters\LegalAction\Resources\LitigationReasonResource\Pages;

use Modules\Legal\Filament\Clusters\LegalAction\Resources\LitigationReasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLitigationReasons extends ManageRecords
{
    protected static string $resource = LitigationReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
