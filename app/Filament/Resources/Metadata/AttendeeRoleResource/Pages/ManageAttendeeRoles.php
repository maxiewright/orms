<?php

namespace App\Filament\Resources\Metadata\AttendeeRoleResource\Pages;

use App\Filament\Resources\Metadata\AttendeeRoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAttendeeRoles extends ManageRecords
{
    protected static string $resource = AttendeeRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
