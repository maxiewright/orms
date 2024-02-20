<?php

namespace Modules\ServiceFund\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AccountTypeEnum: string implements HasColor, HasLabel
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


}
