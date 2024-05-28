<?php

namespace Modules\Legal\Filament\Clusters\Incident\Resources;

use Modules\Legal\Filament\Clusters\Incident;
use Modules\Legal\Filament\Clusters\Incident\Resources\OffenceDivisionsResource\Pages;
use Modules\Legal\Filament\Clusters\Incident\Resources\OffenceDivisionsResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Legal\Models\Ancillary\Infraction\OffenceDivision;

class OffenceDivisionResource extends Resource
{
    protected static ?string $model = OffenceDivision::class;

    protected static ?string $cluster = Incident::class;

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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOffenceDivisions::route('/'),
        ];
    }
}
