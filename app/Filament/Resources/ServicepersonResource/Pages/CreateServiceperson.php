<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Filament\Resources\ServicepersonResource;
use App\Filament\Traits\RedirectToIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceperson extends CreateRecord
{
    use RedirectToIndex;

    protected static string $resource = ServicepersonResource::class;
}
