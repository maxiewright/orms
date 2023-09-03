<?php

namespace App\Filament\Resources\Metadata;

use App\Filament\Resources\Metadata\CompanyResource\Pages;
use App\Filament\Resources\Metadata\CompanyResource\RelationManagers;
use App\Models\Unit\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Metadata";

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('battalion_id')
                    ->label('Battalion')
                    ->relationship('battalion', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Company or Detachment')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('short_name')
                    ->label('Abbreviation')
                    ->required()
                    ->unique(ignoreRecord: true),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultGroup('battalion.name')
            ->columns([
                Tables\Columns\TextColumn::make('battalion.name')
                    ->label('Battalion')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->label('Company or Detachment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('short_name')
                    ->label('Abbreviation')
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCompanies::route('/'),
        ];
    }
}
