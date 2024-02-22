<?php

namespace Modules\ServiceFund\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TransactionTypeEnum: string implements HasColor, HasIcon, HasLabel
{
    case Income = 'income';
    case Expense = 'expense';
    case Transfer = 'transfer';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Income => 'Income',
            self::Expense => 'Expense',
            self::Transfer => 'Transfer',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Income => 'success',
            self::Expense => 'danger',
            self::Transfer => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Income => 'heroicon-o-currency-dollar',
            self::Expense => 'heroicon-o-arrow-up-tray',
            self::Transfer => 'heroicon-o-arrows-right-left',
        };
    }

    public function getTransactionalId(): string
    {
        return match ($this) {
            self::Income => 'Paid By',
            self::Expense => 'Paid To',
            self::Transfer => 'Transferred By',
        };
    }
}
