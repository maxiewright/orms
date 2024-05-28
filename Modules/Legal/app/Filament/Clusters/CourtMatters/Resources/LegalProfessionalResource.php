<?php

namespace Modules\Legal\Filament\Clusters\CourtMatters\Resources;

use Modules\Legal\Filament\Clusters\CourtMatters;
use Modules\Legal\Filament\Clusters\CourtMatters\Resources\LegalProfessionalResource\Pages;
use Modules\Legal\Filament\Clusters\CourtMatters\Resources\LegalProfessionalResource\RelationManagers;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LegalProfessionalResource extends Resource
{
    protected static ?string $model = LegalProfessional::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = CourtMatters::class;

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
            'index' => Pages\ManageLegalProfessionals::route('/'),
        ];
    }
}
