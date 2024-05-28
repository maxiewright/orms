<?php

namespace Modules\Legal\Enums\CourtApperance;

use Filament\Support\Contracts\HasLabel;

enum CourtAppearanceOutcome: string implements HasLabel
{
    case Sentenced = 'sentenced';
    case Acquitted = 'acquitted';
    case Adjourned = 'adjourned';
    case Dismissed = 'dismissed';
    case Withdrawn = 'withdrawn';
    case GuiltyPlea = 'guilty plea';
    case BenchWarrant = 'bench warrant';
    case Appealed = 'appealed';
    case ConditionalDischarge = 'conditional discharge';
    case ContemptOfCourt = 'contempt of court';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Sentenced => 'Sentenced',
            self::Acquitted => 'Acquitted',
            self::Adjourned => 'Adjourned',
            self::Dismissed => 'Dismissed',
            self::Withdrawn => 'Withdrawn',
            self::GuiltyPlea => 'Guilty Plea',
            self::BenchWarrant => 'Bench Warrant',
            self::Appealed => 'Appealed',
            self::ConditionalDischarge => 'Conditional Discharge',
            self::ContemptOfCourt => 'Contempt of Court',
        };
    }
}
