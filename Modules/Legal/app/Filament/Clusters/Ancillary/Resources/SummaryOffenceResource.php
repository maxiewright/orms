<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Filament\Clusters\Ancillary;
use Modules\Legal\Filament\Clusters\Ancillary\Resources\SummaryOffenceResource\Pages;
use Modules\Legal\Filament\Clusters\Ancillary\Resources\SummaryOffenceResource\RelationManagers;
use Modules\Legal\Models\Ancillary\Infraction\SummaryOffence;

class SummaryOffenceResource extends Resource
{
    protected static ?string $model = SummaryOffence::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Ancillary::class;

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
            'index' => Pages\ListSummaryOffences::route('/'),
            'create' => Pages\CreateSummaryOffence::route('/create'),
            'edit' => Pages\EditSummaryOffence::route('/{record}/edit'),
        ];
    }
}
