<?php

namespace App\Filament\Resources\Metadata;

use App\Filament\Resources\Metadata\EnlistmentTypeResource\Pages;
use App\Models\Metadata\EnlistmentType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EnlistmentTypeResource extends Resource
{
    protected static ?string $model = EnlistmentType::class;

    protected static ?string $navigationIcon = 'heroicon-o-chevron-double-down';

    protected static ?string $navigationGroup = 'metadata';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('abbreviation')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('abbreviation'),
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
            'index' => Pages\ManageEnlistmentTypes::route('/'),
        ];
    }
}
