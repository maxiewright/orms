<?php

namespace Modules\Legal\Filament\Clusters\Legal\Resources\InfractionResource\Pages;

use Modules\Legal\Filament\Clusters\Legal\Resources\InfractionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInfraction extends CreateRecord
{
    protected static string $resource = InfractionResource::class;
}
