<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Filament\Resources\ServicepersonResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewServiceperson extends ViewRecord
{
    protected static string $resource = ServicepersonResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->military_name;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->columns(3)
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                ImageEntry::make('image_url')
                                    ->label('')
                                    ->height(200)
                                    ->circular(),
                                Group::make([
                                    TextEntry::make('name'),
                                    TextEntry::make('date_of_birth')
                                        ->date(config('orms.date_format')),
                                ]),
                                Group::make([
                                    TextEntry::make('maritalStatus.name'),
                                    TextEntry::make('religion.name'),
                                    TextEntry::make('ethnicity.name'),
                                ]),
                            ]),
                    ]),
                Section::make('Contact Information')
                    ->columns()
                    ->schema([
                        Group::make([
                            TextEntry::make('emails')
                                ->label('Email')
                                ->listWithLineBreaks(),
                            TextEntry::make('phoneNumbers')
                                ->label('Phone')
                                ->listWithLineBreaks(),
                        ]),

                        TextEntry::make('address'),
                    ]),

                Section::make('Service Data')
                    ->columns(3)
                    ->schema([
                        Group::make([
                            TextEntry::make('employmentStatus.name'),
                            TextEntry::make('job.name'),
                        ]),
                        Group::make([
                            TextEntry::make('battalion.name'),
                            TextEntry::make('company.name'),
                            TextEntry::make('platoon.name')
                                ->placeholder('N/A'),
                        ]),
                        Group::make([
                            TextEntry::make('enlistmentType.name'),
                            TextEntry::make('enlistment_date')
                                ->date(config('orms.date_format')),
                            TextEntry::make('assumption_date')
                                ->date(config('orms.date_format')),
                        ]),
                    ]),
            ]);
    }
}
