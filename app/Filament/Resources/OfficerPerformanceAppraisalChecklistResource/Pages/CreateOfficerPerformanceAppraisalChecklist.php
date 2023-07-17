<?php

namespace App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages;

use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource;
use App\Filament\Traits\RedirectToIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateOfficerPerformanceAppraisalChecklist extends CreateRecord
{

    use RedirectToIndex;

    protected static string $resource = OfficerPerformanceAppraisalChecklistResource::class;


}
