<?php

namespace Modules\Legal\Filament\Resources\IncarcerationResource\Pages;

use Modules\Legal\Filament\Resources\IncarcerationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIncarcerations extends ManageRecords
{
    protected static string $resource = IncarcerationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver(),
        ];
    }
}
