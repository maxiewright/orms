<?php

namespace Modules\Legal\Filament\Clusters\Incident\Resources;

use Modules\Legal\Filament\Clusters\Incident;
use Modules\Legal\Filament\Clusters\Incident\Resources\LegalTagResource\Pages;
use Modules\Legal\Filament\Clusters\Incident\Resources\LegalTagResource\RelationManagers;
use Modules\Legal\Models\Ancillary\Infraction\LegalTag;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LegalTagResource extends Resource
{
    protected static ?string $model = LegalTag::class;

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
            'index' => Pages\ManageLegalTags::route('/'),
        ];
    }
}
