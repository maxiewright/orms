<?php

namespace Modules\ServiceFund\Filament\App\Resources;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\BankBranch;
use Modules\ServiceFund\Filament\App\Resources\BankBranchResource\Pages;

class BankBranchResource extends Resource
{
    protected static ?string $model = BankBranch::class;

    protected static ?string $navigationGroup = 'Metadata';

    protected static ?string $label = 'Bank';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Branches (Bank - Address)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_head_office')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('bank')
                    ->relationship('bank', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form(BankBranch::getForm())
                    ->slideOver(),
                Tables\Actions\DeleteAction::make(),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankBranches::route('/'),
        ];
    }
}
