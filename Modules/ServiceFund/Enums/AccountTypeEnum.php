<?php

namespace Modules\ServiceFund\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AccountTypeEnum: string implements HasColor, HasLabel, HasIcon
{
    case Savings = 'savings';
    case Checking = 'checking';
    case Cash = 'cash';
    case Credit = 'credit';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Savings => 'Savings',
            self::Checking => 'Checking',
            self::Cash => 'Cash',
            self::Credit => 'Credit',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::Savings => 'success',
            self::Checking => 'gray',
            self::Cash => 'info',
            self::Credit => 'danger',
        };
    }


    public function getIcon(): ?string
    {
        return match ($this) {
            self::Savings => 'heroicon-o-building-library',
            self::Checking => 'heroicon-o-pencil-square',
            self::Cash => 'heroicon-0-banknotes',
            self::Credit => 'heroicon-o-credit-card',
        };
    }
}
