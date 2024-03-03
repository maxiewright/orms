<?php

namespace Modules\ServiceFund\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasColor, HasIcon, HasLabel
{
    case Cash = 'cash';
    case Cheque = 'cheque';
    case BankTransfer = 'bank-transfer';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Cash => 'info',
            self::Cheque => 'success',
            self::BankTransfer => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Cash => 'heroicon-o-banknotes',
            self::Cheque => 'heroicon-o-pencil-square',
            self::BankTransfer => 'heroicon-o-arrows-right-left',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Cash => 'Cash',
            self::Cheque => 'Cheque',
            self::BankTransfer => 'Bank Transfer',
        };
    }
}
