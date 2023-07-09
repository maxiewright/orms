<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages;
use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\RelationManagers;
use App\Models\OfficerPerformanceAppraisalChecklist;
use App\Rules\RequireIfFieldIsTrue;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Util\Filter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class OfficerPerformanceAppraisalChecklistResource extends Resource
{
    protected static ?string $model = OfficerPerformanceAppraisalChecklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'officers';

    protected static ?string $modelLabel = 'Appraisal Checklist';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Basic Info')->schema([
                    Forms\Components\Select::make('serviceperson_number')
                        ->relationship('serviceperson', 'number')
                        ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->military_name}")
                        ->searchable(['number', 'first_name', 'last_name'])
                        ->required(),

                    Forms\Components\DatePicker::make('appraisal_start_at')
                        ->required(),
                    Forms\Components\DatePicker::make('appraisal_end_at')
                        ->required(),
                ]),
                // Verification
                Forms\Components\Fieldset::make('Appointment & Assessment Verification')->schema([
                    Forms\Components\Toggle::make('is_appointment_correct')
                        ->label('Did the officer hold the appointment identified on the appraisal for the period assessed?')
                        ->required()
                    , Forms\Components\Toggle::make('company_commander_assessment_completed')
                        ->label('Is the assessment rubric complete?')
                        ->required(),
                ])->columns(1),
                //Company Command
                Forms\Components\Fieldset::make('Company Commander')->schema([
                    Forms\Components\Toggle::make('has_company_commander')
                        ->label('This officer has a company commander?'),
                    Forms\Components\Toggle::make('has_company_commander_comments')
                        ->label('Does it have company commander comments?')
                        ->rule(new RequireIfFieldIsTrue('has_company_commander', 'company commander')),
                    Forms\Components\Toggle::make('has_company_commander_signature')
                        ->label('Is it signed by the company commander?')
                        ->rule(new RequireIfFieldIsTrue('has_company_commander', 'company commander')),
                ])->columns(3),
                // Unit Command
                Forms\Components\Fieldset::make('Unit Commander')->schema([
                    Forms\Components\Toggle::make('has_unit_commander')
                        ->label('Does this officer have a unit commander?'),
                    Forms\Components\Toggle::make('has_unit_commander_comments')
                        ->label('Does it have unit commander comments?')
                        ->rule(new RequireIfFieldIsTrue('has_unit_commander', 'unit commander')),
                    Forms\Components\Toggle::make('has_unit_commander_signature')
                        ->label('Is it signed by the unit commander?')
                        ->rule(new RequireIfFieldIsTrue('has_unit_commander', 'unit commander')),
                ])->columns(3),
                // Formation Command
                Forms\Components\Fieldset::make('Formation Commander')->schema([
                    Forms\Components\Toggle::make('has_formation_commander_comments')
                        ->label('Does it have formation commander comments?'),
                    Forms\Components\Toggle::make('has_formation_commander_signature')
                        ->label('Is it signed by the formation commander?'),
                ])->columns(3),
                // Officer
                Forms\Components\Fieldset::make('Serviceperson')->schema([
                    Forms\Components\Toggle::make('has_serviceperson_signature')
                        ->label('Is it signed by the Officer?'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('serviceperson.military_name')
                    ->label('Name')
                    ->searchable(['number', 'first_name', 'last_name']),
                Tables\Columns\TextColumn::make('appraisal_start_at')
                    ->label('Form')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('appraisal_end_at')
                    ->label('To')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_appointment_correct')
                    ->label('Appointment Correct')
                    ->boolean(),
                Tables\Columns\IconColumn::make('company_commander_assessment_completed')
                    ->label('Rubric Complete')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_company_commander_comments')
                    ->label('OC Comments')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_company_commander_signature')
                    ->label('OC Signature')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_unit_commander_comments')
                    ->label('CO Comments')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_unit_commander_signature')
                    ->label('CO Signature')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_formation_commander_comments')
                    ->label('COTTR Comments')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_formation_commander_signature')
                    ->label('COTTR Signature')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_serviceperson_signature')
                    ->label('Soldier Signature')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('appraisal_start_at'),
                        Forms\Components\DatePicker::make('appraisal_end_at'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['appraisal_start_at'],
                                fn(Builder $query, $date): Builder => $query->whereDate('appraisal_start_at', '>=', $date),
                            )
                            ->when(
                                $data['appraisal_end_at'],
                                fn(Builder $query, $date): Builder => $query->whereDate('appraisal_end_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
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
            'index' => Pages\ListOfficerPerformanceAppraisalChecklists::route('/'),
            'create' => Pages\CreateOfficerPerformanceAppraisalChecklist::route('/create'),
            'edit' => Pages\EditOfficerPerformanceAppraisalChecklist::route('/{record}/edit'),
        ];
    }
}
