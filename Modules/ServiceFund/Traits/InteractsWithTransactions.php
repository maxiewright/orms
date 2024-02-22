<?php

namespace Modules\ServiceFund\Traits;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\TransactionTypeEnum;

trait InteractsWithTransactions
{
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::ucwords($value),
            set: fn ($value) => Str::lower($value),
        );
    }

    public static function getTransactionTableColumns($transactions): array
    {
        return [
            TextColumn::make('executed_at'),
            TextColumn::make('amount')
                ->money(config('servicefund.currency')),
            TextColumn::make('payment_method'),
            TextColumn::make('categories.name'),
            TextColumn::make('transactional.name')
                ->label(function () use ($transactions) {

                    $transactionType = $transactions->first()->type;

                    return match ($transactionType) {
                        TransactionTypeEnum::Income => 'Paid By',
                        TransactionTypeEnum::Expense => 'Paid To',
                        TransactionTypeEnum::Transfer => 'Transferred By'
                    };
                }),
            TextColumn::make('approved_by')
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('approved_at')
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
