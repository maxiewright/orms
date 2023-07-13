<?php

namespace App\Filament\Resources\ServicepersonResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class OfficerPerformanceAppraisalChecklistsRelationManager extends RelationManager
{
    protected static string $relationship = 'officerPerformanceAppraisalChecklists';

    protected static ?string $recordTitleAttribute = 'serviceperson_number';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('serviceperson_number')
                    ->relationship('serviceperson', 'number')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                    ->searchable(['number', 'first_name', 'last_name'])
                    ->required(),
                Forms\Components\DateTimePicker::make('appraisal_start_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('appraisal_end_at')
                    ->required(),
                Forms\Components\Toggle::make('is_appointment_correct')
                    ->required(),
                Forms\Components\Toggle::make('company_commander_assessment_completed'),
                Forms\Components\Toggle::make('has_company_commander_comments'),
                Forms\Components\Toggle::make('has_company_commander_signature'),
                Forms\Components\Toggle::make('has_unit_commander_comments'),
                Forms\Components\Toggle::make('has_unit_commander_signature'),
                Forms\Components\Toggle::make('has_formation_commander_comments'),
                Forms\Components\Toggle::make('has_formation_commander_signature'),
                Forms\Components\Toggle::make('has_serviceperson_signature'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('appraisal_start_at')
                    ->label('Form')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('appraisal_end_at')
                    ->label('To')
                    ->date('d M Y'),
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
