<?php

namespace Modules\Legal\Filament\Resources\LegalActionResource\Pages;

use Modules\Legal\Filament\Resources\LegalActionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegalActions extends ListRecords
{
    protected static string $resource = LegalActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
