<?php

namespace Modules\Legal\Enums\Incident;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum IncidentStatus: string implements HasColor, HasLabel
{
    case PendingCharge = 'pending charge';
    case Charged = 'charged';
    case Dismissed = 'dismissed';
    case Convicted = 'convicted';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PendingCharge => 'Pending Charge',
            self::Charged => 'Charged',
            self::Dismissed => 'Dismissed',
            self::Convicted => 'Convicted',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PendingCharge => 'gray',
            self::Charged => 'warning',
            self::Dismissed => 'success',
            self::Convicted => 'danger',
        };
    }
}
