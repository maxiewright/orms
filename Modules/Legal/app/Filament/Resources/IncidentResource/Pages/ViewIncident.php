<?php

namespace Modules\Legal\Filament\Resources\IncidentResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Grid;
use Filament\Resources\Pages\ViewRecord;
use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Filament\Resources\IncidentResource;
use Modules\Legal\Models\Charge;

class ViewIncident extends ViewRecord
{
    protected static string $resource = IncidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            CreateAction::make('Add Charges')
                ->hidden(function () {
                    if ($this->record->status === IncidentStatus::Charged) {
                        return false;
                    }
                    if ($this->record->status === IncidentStatus::PendingCharge) {
                        return false;
                    }

                    return true;
                })
                ->label('Add Charge')
                ->slideOver()
                ->model(Charge::class)
                ->form([
                    Grid::make()->schema(Charge::getForm()),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $data['incident_id'] = $this->record->id;

                    return $data;
                })
                ->before(function () {
                    if ($this->record->status !== IncidentStatus::Charged) {
                        $this->record->update([
                            'status' => IncidentStatus::Charged,
                        ]);
                    }
                }),
        ];
    }
}
