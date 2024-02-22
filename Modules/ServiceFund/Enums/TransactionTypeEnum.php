<?php

namespace Modules\ServiceFund\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TransactionTypeEnum: string implements HasColor, HasIcon, HasLabel
{
    case Debit = 'debit';
    case Credit = 'credit';
    case Transfer = 'transfer';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Debit => 'Debit',
            self::Credit => 'Credit',
            self::Transfer => 'Transfer',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Debit => 'success',
            self::Credit => 'danger',
            self::Transfer => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Debit => 'heroicon-o-currency-dollar',
            self::Credit => 'heroicon-o-arrow-up-tray',
            self::Transfer => 'heroicon-o-arrows-right-left',
        };
    }

    public function getTransactionalId(): string
    {
        return match ($this) {
            self::Debit => 'Paid By',
            self::Credit => 'Paid To',
            self::Transfer => 'Transferred By',
        };
    }
}
