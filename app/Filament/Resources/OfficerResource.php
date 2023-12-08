<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficerResource\Pages;
use App\Filament\Resources\OfficerResource\Widgets\OfficersUnitOverview;
use App\Models\Metadata\ServiceData\Job;
use App\Models\Metadata\ServiceData\JobCategory;
use App\Models\Officer;
use App\Models\Serviceperson;
use App\Models\Unit\Company;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class OfficerResource extends Resource
{
    protected static ?string $model = Officer::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Officers';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema(self::administrationForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups(groups: [
                Group::make('battalion.short_name')
                    ->label('Unit')
                    ->collapsible(),
                Group::make(id: 'employmentStatus.name')
                    ->label('Status')
                    ->collapsible(),
            ])->defaultGroup('battalion.short_name')
            ->columns([
                TextColumn::make('military_name')
                    ->searchable(['number', 'first_name', 'last_name'])
                    ->sortable(['number'])
                    ->label('Name'),
                TextColumn::make('employmentStatus.short_name'),
                TextColumn::make('battalion.short_name'),
                TextColumn::make('company.short_name'),
                TextColumn::make('job.short_name'),
            ])
            ->filters([
                SelectFilter::make('employment status')
                    ->relationship('employmentStatus', 'short_name')
                    ->preload()
                    ->multiple(),
                SelectFilter::make('battalion')
                    ->relationship('battalion', 'short_name')
                    ->preload()
                    ->multiple(),
                SelectFilter::make('company')
                    ->relationship('company', 'short_name')
                    ->searchable()
                    ->multiple(),
                SelectFilter::make('rank')
                    ->relationship('rank', 'regiment_abbreviation')
                    ->preload()
                    ->multiple(),
                SelectFilter::make('enlistment_type')
                    ->relationship('enlistmentType', 'name')
                    ->preload()
                    ->multiple(),
                SelectFilter::make('gender')
                    ->relationship('gender', 'name'),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(6)
            ->persistFiltersInSession()
            ->actions([
                EditAction::make()
                    ->icon('heroicon-o-clipboard-document-check')
                    ->label('Administrate')
                    ->modalHeading(fn (Serviceperson $record): string => "Administrate {$record->military_name}")
                    ->fillForm(fn (Serviceperson $record) => [
                        'company_id' => $record->company_id,
                        'category' => ($record->job) ? $record->job->category->id : '',
                        'job_id' => $record->job_id,
                    ])
                    ->using(function (Serviceperson $record, array $data) {
                        $record->update([
                            'employment_status_id' => $data['employment_status_id'],
                            'battalion_id' => $data['battalion_id'],
                            'company_id' => $data['company_id'],
                            'job_id' => $data['job_id'],
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\BulkAction::make('Administrate Selected')
                        ->icon('heroicon-o-clipboard-document-check')
                        ->form(self::administrationForm())
                        ->action(function (Collection $records, array $data) {
                            foreach ($records as $record) {
                                $record->update([
                                    'employment_status_id' => $data['employment_status_id'],
                                    'battalion_id' => $data['battalion_id'],
                                    'company_id' => $data['company_id'],
                                    'job_id' => $data['job_id'],
                                ]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->emptyStateActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfficers::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            OfficersUnitOverview::class,
        ];
    }

    public static function administrationForm(): array
    {
        return [
            Fieldset::make('Employment')->schema([
                Select::make('employment_status_id')
                    ->label('Employment Status')
                    ->relationship('employmentStatus', 'name')
                    ->default(1)
                    ->selectablePlaceholder(false),
            ]),
            Fieldset::make('Unit')->schema([
                Select::make('battalion_id')
                    ->label('Battalion')
                    ->relationship('battalion', 'short_name')
                    ->live(),
                Select::make('company_id')
                    ->label('Company')
                    ->options(fn (Get $get) => Company::query()
                        ->where('battalion_id', $get('battalion_id'))
                        ->pluck('short_name', 'id')),
            ]),
            Fieldset::make('Job')->schema([
                Select::make('category')
                    ->options(fn () => JobCategory::query()
                        ->pluck('name', 'id'))
                    ->live(),
                Select::make('job_id')
                    ->label('Job')
                    ->options(fn (Get $get) => Job::query()
                        ->where('job_category_id', $get('category'))
                        ->pluck('name', 'id')),
            ]),
        ];
    }
}
