<?php

namespace App\Filament\Resources;

use App\Enums\RankEnum;
use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages;
use App\Models\OfficerPerformanceAppraisalChecklist;
use App\Rules\RequireIfFieldIsTrue;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                // Basic Information
                Forms\Components\Fieldset::make('Basic Info')->schema([
                    Forms\Components\Select::make('serviceperson_number')
                        ->relationship('serviceperson', 'number',
                            fn(Builder $query) => $query->where('rank_id', '>=', RankEnum::O1))
                        ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->military_name}")
                        ->searchable(['number', 'first_name', 'last_name'])
                        ->required(),
                    Forms\Components\DatePicker::make('appraisal_start_at')
                        ->displayFormat('d M Y')
                        ->required()
                        ->before('appraisal_end_at'),
                    Forms\Components\DatePicker::make('appraisal_end_at')
                        ->displayFormat('d M Y')
                        ->required()
                        ->after('appraisal_start_at')
                        ->beforeOrEqual('today'),
                ]),

                // Verification
                Forms\Components\Fieldset::make('Appointment & Assessment Verification')->schema([
                    Forms\Components\Toggle::make('is_appointment_correct')
                        ->label('Did the officer hold the appointment identified on the appraisal for the period assessed?')
                        ->required(), Forms\Components\Toggle::make('is_assessment_rubric_complete')
                        ->label('Is the assessment rubric complete?')
                        ->required(),
                ])->columns(1),

                //Company Command
                Forms\Components\Fieldset::make('Company Commander')->schema([
                    Forms\Components\Toggle::make('has_company_commander')
                        ->label('Does this officer have a company commander?'),
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

                // Grading and Discipline
                Forms\Components\Fieldset::make('Grading and Discipline')->schema([
                    Forms\Components\Select::make('officer_appraisal_grade_id')
                        ->label('Substantive rank grading')
                        ->relationship('grade', 'name')
                        ->required()
                        ->preload(),
                    Forms\Components\Toggle::make('has_disciplinary_action')
                        ->label('Was any disciplinary action taken against this officer for the period under review?'),
                    Forms\Components\Textarea::make('disciplinary_action_particulars')
                        ->label('Particulars of disciplinary action, if any was taken in the period under review')
                        ->requiredIf('has_disciplinary_action', 'true',),
                ])->columns(3),

                // Formation Command
                Forms\Components\Fieldset::make('Formation Commander')->schema([
                    Forms\Components\Toggle::make('has_formation_commander_comments')
                        ->label('Does it have formation commander comments?'),
                    Forms\Components\Toggle::make('has_formation_commander_signature')
                        ->label('Is it signed by the formation commander?'),
                ])->columns(3),

                // Officer Signature
                Forms\Components\Fieldset::make('Serviceperson')->schema([
                    Forms\Components\Toggle::make('has_serviceperson_signature')
                        ->label('Is it signed by the Officer?')
                        ->requiredIf('has_formation_commander_signature', 'true',),
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
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereYear('appraisal_end_at', $search);
                    }),
                Tables\Columns\IconColumn::make('is_appointment_correct')
                    ->label('Appointment Correct')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_assessment_rubric_complete')
                    ->label('Rubric Complete')
                    ->boolean(),

                // Company Commander
                Tables\Columns\IconColumn::make('has_company_commander_comments')
                    ->label('OC Comments')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_company_commander_signature')
                    ->label('OC Signature')
                    ->boolean(),

                // Unit Commanding Officer
                Tables\Columns\IconColumn::make('has_unit_commander_comments')
                    ->label('CO Comments')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_unit_commander_signature')
                    ->label('CO Signature')
                    ->boolean(),

                // Grading and Discipline
                Tables\Columns\TextColumn::make('grade.name')
                    ->label('Overall Grade'),
                Tables\Columns\IconColumn::make('has_disciplinary_action')
                    ->label('Disciplinary Action')
                    ->boolean(),

                // Formation Commander
                Tables\Columns\IconColumn::make('has_formation_commander_comments')
                    ->label('COTTR Comments')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_formation_commander_signature')
                    ->label('COTTR Signature')
                    ->boolean(),

                // Officer Signature
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
                    }),
                Tables\Filters\SelectFilter::make('grade')
                    ->relationship('grade', 'name'),
                Tables\Filters\Filter::make('Completed_by_company_commander')
                    ->query(fn(Builder $query): Builder => $query->completedByCompanyCommander()),
                Tables\Filters\Filter::make('completed_by_unit_commander')
                    ->query(fn(Builder $query): Builder => $query->completedByUnitCommander()),
                Tables\Filters\Filter::make('has_disciplinary_action')
                    ->query(fn(Builder $query): Builder => $query->hasDisciplinaryAction()),
                Tables\Filters\Filter::make('completed_by_formation_commander')
                    ->query(fn(Builder $query): Builder => $query->completedByFormationCommander()),
                Tables\Filters\Filter::make('completed')
                    ->query(fn(Builder $query): Builder => $query->completed()),
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
