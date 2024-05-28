<?php

namespace Modules\Legal\Filament\Clusters\LegalAction\Resources\DefendantResource\Pages;

use Modules\Legal\Filament\Clusters\LegalAction\Resources\DefendantResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDefendants extends ManageRecords
{
    protected static string $resource = DefendantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
