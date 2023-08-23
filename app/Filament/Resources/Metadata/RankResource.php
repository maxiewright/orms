<?php

namespace App\Filament\Resources\Metadata;

use App\Filament\Resources\Metadata\RankResource\Pages;
use App\Models\Metadata\Rank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RankResource extends Resource
{
    protected static ?string $model = Rank::class;

    protected static ?string $navigationIcon = 'heroicon-o-chevron-double-down';

    protected static ?string $navigationGroup = 'Metadata';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('regiment')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('regiment_abbreviation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('coast_guard')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('coast_guard_abbreviation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('air_guard')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('air_guard_abbreviation')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('regiment'),
                Tables\Columns\TextColumn::make('regiment_abbreviation'),
                Tables\Columns\TextColumn::make('coast_guard'),
                Tables\Columns\TextColumn::make('coast_guard_abbreviation'),
                Tables\Columns\TextColumn::make('air_guard'),
                Tables\Columns\TextColumn::make('air_guard_abbreviation'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRanks::route('/'),
        ];
    }
}
