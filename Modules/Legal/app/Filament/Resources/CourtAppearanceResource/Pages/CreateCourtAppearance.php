<?php

namespace Modules\Legal\Filament\Resources\CourtAttendenceResource\Pages;

use Modules\Legal\Filament\Resources\CourtAppearanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourtAppearance extends CreateRecord
{
    protected static string $resource = CourtAppearanceResource::class;
}