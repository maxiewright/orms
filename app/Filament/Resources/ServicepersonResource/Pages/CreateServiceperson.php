<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Filament\Resources\ServicepersonResource;
use App\Filament\Traits\RedirectToIndex;
use App\Models\Serviceperson;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceperson extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard, RedirectToIndex;

    protected static string $resource = ServicepersonResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['division']);

        return $data;
    }

    public function hasSkippableSteps(): bool
    {
        return true;
    }

    protected function getSteps(): array
    {

        return [
            Step::make('Personal Data')
                ->schema(Serviceperson::personalDataSchema())->columns(1),
            Step::make('Contact Information')
                ->schema(Serviceperson::contactInformationSchema()),
            Step::make('Service Data')
                ->schema(Serviceperson::serviceDataSchema()),
            // Emergency Contact
            Step::make('Emergency Contact')
                ->schema(Serviceperson::emergencyContactSchema())->columns(1),
        ];
    }
}
