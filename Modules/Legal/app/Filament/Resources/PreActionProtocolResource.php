<?php

namespace Modules\Legal\Filament\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Filament\Resources\PreActionProtocolResource\Pages;
use Modules\Legal\Models\PreActionProtocol;

class PreActionProtocolResource extends Resource
{
    protected static ?string $model = PreActionProtocol::class;

    protected static ?string $navigationGroup = 'Legal Actions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPreActionProtocols::route('/'),
            'create' => Pages\CreatePreActionProtocol::route('/create'),
            'edit' => Pages\EditPreActionProtocol::route('/{record}/edit'),
        ];
    }
}
