<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Serviceperson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\Filament\Resources\InterdicationResource\Pages;
use Modules\Legal\Models\Incident;
use Modules\Legal\Models\Interdiction;

class InterdictionResource extends Resource
{
    protected static ?string $model = Interdiction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Select::make('serviceperson_number')
                    ->helperText('Search by number, first name, middle name or last name')
                    ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
                    ->searchable()
                    ->live()
                    ->options(function () {
                        return Serviceperson::query()
                            ->whereHas('incidents')
                            ->get()
                            ->pluck('military_name', 'number');
                    }),
                Forms\Components\Select::make('incident_id')
                    ->placeholder(fn (Get $get) => $get('serviceperson')
                        ? 'Select an incident'
                        : 'Select Serviceperson first')
                    ->options(function (?Interdiction $record, Get $get, Forms\Set $set) {
                        if (! empty($record) && empty($get('serviceperson_number'))) {
                            $set('serviceperson_number', $record->incident->serviceperson_number);
                            $set('incident_id', $record->incident_id);
                        }

                        return Incident::query()
                            ->where('serviceperson_number', $get('serviceperson_number'))
                            ->get()
                            ->pluck('name', 'id');
                    })
                    ->unique()
                    ->validationMessages([
                        'unique' => 'An :attribute record already exist for this incident',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options(InterdictionStatus::class)
                    ->enum(InterdictionStatus::class)
                    ->default(InterdictionStatus::Pending)
                    ->required()
                    ->live(),
                Forms\Components\DateTimePicker::make('requested_at')
                    ->label('Date Requested')
                    ->required()
                    ->beforeOrEqual('now'),
                Forms\Components\DateTimePicker::make('interdicted_at')
                    ->label('Date Interdicted')
                    ->required(fn (Get $get) => $get('status') !== InterdictionStatus::Pending)
                    ->beforeOrEqual('now')
                    ->after('requested_at'),
                Forms\Components\DateTimePicker::make('lifted_at')
                    ->label('Date Lifted')
                    ->required(fn (Get $get) => $get('status') === InterdictionStatus::Lifted)
                    ->after('interdicted_at'),
                Interdiction::getReferences()->columnSpanFull(),
                Forms\Components\RichEditor::make('particulars')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('incident.serviceperson.name')
                    ->description(function ($record) {
                        return $record->name;
                    })
                    ->label('Serviceperson'),
                Tables\Columns\TextColumn::make('incident.charges.offenceSection.name')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->wrap()
                    ->label('Charges'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('interdicted_at')
                    ->label('Interdiction Date')
                    ->placeholder('Pending Response')
                    ->date(),
                Tables\Columns\TextColumn::make('lifted_at')
                    ->label('Interdiction Lift Date')
                    ->placeholder(function ($record) {
                        return $record->status === InterdictionStatus::Interdicted
                            ? 'On going'
                            : 'Pending Response';
                    })
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInterdications::route('/'),
            'create' => Pages\CreateInterdication::route('/create'),
            'edit' => Pages\EditInterdication::route('/{record}/edit'),
        ];
    }
}
