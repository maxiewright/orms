<?php

namespace App\Filament\Resources\BattalionResource\Pages;

use App\Filament\Resources\BattalionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBattalions extends ManageRecords
{
    protected static string $resource = BattalionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
