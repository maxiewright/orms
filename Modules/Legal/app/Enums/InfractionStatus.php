<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum InfractionStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';
    case Charged = 'charged';
    case Dismissed = 'dismissed';
    case Convicted = 'convicted';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Charged => 'Charged',
            self::Dismissed => 'Dismissed',
            self::Convicted => 'Convicted',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Charged => 'yellow',
            self::Dismissed => 'green',
            self::Convicted => 'red',
        };
    }
}
