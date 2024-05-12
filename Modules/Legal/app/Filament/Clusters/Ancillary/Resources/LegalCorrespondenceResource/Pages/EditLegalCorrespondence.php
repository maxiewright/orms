<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalCorrespondenceResource\Pages;

use Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalCorrespondenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLegalCorrespondence extends EditRecord
{
    protected static string $resource = LegalCorrespondenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
