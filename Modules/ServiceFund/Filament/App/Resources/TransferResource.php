<?php

namespace Modules\ServiceFund\Filament\App\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\Transfer;
use Modules\ServiceFund\Filament\App\Resources\TransferResource\Pages;

class TransferResource extends Resource
{
    protected static ?string $model = Transfer::class;

    protected static ?string $navigationGroup = 'Banking';

    public static function getNavigationLabel(): string
    {
        return 'All Transfers';
    }

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
                Tables\Columns\TextColumn::make('creditAccount.name')
                    ->label('From'),
                Tables\Columns\TextColumn::make('debitAccount.name')
                    ->label('To'),
                Tables\Columns\TextColumn::make('transferred_at')
                    ->label('Transferred on')
                    ->date(config('servicefund.timestamp.date')),
                Tables\Columns\TextColumn::make('amount_in_cents')
                    ->label('Amount')
                    ->money(config('servicefund.currency')),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Transfer Method'),
                Tables\Columns\TextColumn::make('Remitter'),
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
            'index' => Pages\ListTransfers::route('/'),
            'create' => Pages\CreateTransfer::route('/create'),
            'edit' => Pages\EditTransfer::route('/{record}/edit'),
        ];
    }
}
