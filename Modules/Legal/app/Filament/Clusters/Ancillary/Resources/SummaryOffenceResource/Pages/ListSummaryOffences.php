<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources\SummaryOffenceResource\Pages;

use Modules\Legal\Filament\Clusters\Ancillary\Resources\SummaryOffenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSummaryOffences extends ListRecords
{
    protected static string $resource = SummaryOffenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
