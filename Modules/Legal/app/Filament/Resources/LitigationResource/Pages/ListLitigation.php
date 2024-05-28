<?php

namespace Modules\Legal\Filament\Resources\LitigationResource\Pages;

use Modules\Legal\Filament\Resources\LitigationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLitigation extends ListRecords
{
    protected static string $resource = LitigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
