<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexGroupResource\Pages;

use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndexGroup extends CreateRecord
{
    protected static string $resource = IndexGroupResource::class;
}
