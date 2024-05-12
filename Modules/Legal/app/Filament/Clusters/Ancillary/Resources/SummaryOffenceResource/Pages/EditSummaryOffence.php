<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources\SummaryOffenceResource\Pages;

use Modules\Legal\Filament\Clusters\Ancillary\Resources\SummaryOffenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSummaryOffence extends EditRecord
{
    protected static string $resource = SummaryOffenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
