<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Filament\Resources\ServicepersonResource;
use App\Filament\Traits\RedirectToIndex;
use Filament\Forms\Form;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceperson extends EditRecord
{
    use RedirectToIndex;

    protected static string $resource = ServicepersonResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['division']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return parent::form($form); // TODO: Change the autogenerated stub
    }
}
