<?php

namespace App\Filament\Resources\Metadata\RankResource\Pages;

use App\Filament\Resources\Metadata\RankResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRanks extends ManageRecords
{
    protected static string $resource = RankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
