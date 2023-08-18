<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicepersonResource\Pages;
use App\Models\Serviceperson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ServicepersonResource extends Resource
{
    protected static ?string $model = Serviceperson::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Servicepeople';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('formation_id')
                    ->relationship('formation', 'name')
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('rank_id')
                    ->relationship('rank', 'name')
                    ->required(),
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\Select::make('gender_id')
                    ->relationship('gender', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required()
                    ->displayFormat('d M Y'),
                Forms\Components\Select::make('enlistment_type_id')
                    ->relationship('enlistmentType', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('enlistment_date')
                    ->required()
                    ->displayFormat('d M Y'),
                Forms\Components\DatePicker::make('assumption_date')
                    ->required()
                    ->displayFormat('d M Y'),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('military_name')
                    ->searchable(['number', 'first_name', 'last_name'])
                    ->label('Name'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('enlistmentType.name'),
                Tables\Columns\TextColumn::make('enlistment_date')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('assumption_date')
                    ->date('d M Y'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rank')
                    ->relationship('rank', 'regiment_abbreviation')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('enlistment_type')
                    ->relationship('enlistmentType', 'name')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('gender')
                    ->relationship('gender', 'name'),

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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicepeople::route('/'),
            'create' => Pages\CreateServiceperson::route('/create'),
            'view' => Pages\ViewServiceperson::route('/{record}'),
            'edit' => Pages\EditServiceperson::route('/{record}/edit'),
        ];
    }
}
