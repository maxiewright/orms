<?php

namespace Modules\Legal\Enums\Incident;

use Filament\Support\Contracts\HasLabel;

enum IncidentType: string implements HasLabel
{
    case Criminal = 'criminal';
    case Civil = 'civil';
    case Traffic = 'traffic';
    case Domestic = 'domestic';
    case PublicOrder = 'public_order';
    case Cyber = 'cyber';


    public function getLabel(): ?string
    {
        return match ($this) {
            self::Criminal => 'Criminal',
            self::Civil => 'Civil',
            self::Traffic => 'Traffic',
            self::Domestic => 'Domestic',
            self::PublicOrder => 'Public Order',
            self::Cyber => 'Cyber',
        };
    }
}
