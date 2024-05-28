<?php

namespace Modules\Legal\Filament\Clusters\LegalAction\Resources\LitigationRulingResource\Pages;

use Modules\Legal\Filament\Clusters\LegalAction\Resources\LitigationRulingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLitigationRulings extends ManageRecords
{
    protected static string $resource = LitigationRulingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
