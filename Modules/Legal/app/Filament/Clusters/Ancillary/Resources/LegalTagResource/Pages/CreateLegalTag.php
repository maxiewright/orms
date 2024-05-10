<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalTagResource\Pages;

use Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalTagResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLegalTag extends CreateRecord
{
    protected static string $resource = LegalTagResource::class;
}
