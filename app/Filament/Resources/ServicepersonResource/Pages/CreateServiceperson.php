<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Enums\Serviceperson\EmailTypeEnum;
use App\Enums\Serviceperson\EmergencyContactTypeEnum;
use App\Enums\Serviceperson\PhoneTypeEnum;
use App\Filament\Resources\ServicepersonResource;
use App\Filament\Traits\RedirectToIndex;
use App\Models\Metadata\Contact\City;
use App\Models\Metadata\Contact\Division;
use App\Models\Serviceperson;
use App\Models\Unit\Company;
use App\Models\Unit\Formation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Collection;

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
