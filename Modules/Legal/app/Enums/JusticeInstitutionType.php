<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasLabel;

enum JusticeInstitutionType: string implements HasLabel
{
    case MagistrateCourt = 'magistrate court';
    case HighCourt = 'high court';
    case CourtOfAppeal = 'court of appeal';
    case PoliceStation = 'police station';
    case CorrectionalFacility = 'correctional facility';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MagistrateCourt => 'Magistrate Court',
            self::HighCourt => 'High Court',
            self::CourtOfAppeal => 'Court of Appeal',
            self::PoliceStation => 'Police Station',
            self::CorrectionalFacility => 'Correctional Facility',
        };
    }
}
