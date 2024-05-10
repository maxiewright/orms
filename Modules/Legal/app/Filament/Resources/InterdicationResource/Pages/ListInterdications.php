<?php

namespace Modules\Legal\Filament\Resources\InterdicationResource\Pages;

use Modules\Legal\Filament\Resources\InterdictionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInterdications extends ListRecords
{
    protected static string $resource = InterdictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
