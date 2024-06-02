<?php

namespace Modules\Legal\Filament\Resources\InterdictionResource\Pages;

use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\Filament\Resources\InterdictionResource;

class ViewInterdiction extends ViewRecord
{
    protected static string $resource = InterdictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public static function infolistSchema(): array
    {
        return [
            Fieldset::make('Interdiction')
                ->columns(4)
                ->schema([
                    TextEntry::make('incident.serviceperson')
                        ->label('Serviceperson')
                        ->formatStateUsing(function ($state) {
                            return "$state->military_name <br> {$state->battalion?->short_name} - {$state->company?->short_name}";
                        })->html(),
                    TextEntry::make('requested_at')
                        ->label('Request Sent')
                        ->date(config('legal.date')),
                    TextEntry::make('interdicted_at')
                        ->label('Date Interdicted')
                        ->date(config('legal.date'))
                        ->placeholder('Pending Response'),
                    TextEntry::make('revoked_at')
                        ->label('Date Revoked')
                        ->placeholder(function ($record) {
                            return $record->status == InterdictionStatus::Interdicted
                                ? 'On going'
                                : 'Pending Response';
                        })
                        ->date(config('legal.date')),
                ]),
            Fieldset::make('Incident')
                ->columns(3)
                ->schema([
                    TextEntry::make('incident.type')
                        ->label('Type'),
                    TextEntry::make('incident.occurred_at')
                        ->label('Date and Time')
                        ->date(config('legal.datetime')),
                    TextEntry::make('incident.status')
                        ->label('Status')
                        ->badge(),
                    TextEntry::make('incident.charges.offenceSection.name')
                        ->label('Charges')
                        ->columnSpanFull()
                        ->bulleted(),
                ]),
            Fieldset::make('References & Particulars')
                ->schema([
                    TextEntry::make('references.name')
                        ->url(route('filament.legal.correspondence'))
                        ->columnSpanFull()
                        ->bulleted(),
                    TextEntry::make('particulars')
                        ->placeholder('No particulars provided')
                        ->columnSpanFull()
                        ->html(),
                ]),
        ];
    }
}
