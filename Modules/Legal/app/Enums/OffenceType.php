<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasLabel;

enum OffenceType: string implements HasLabel
{
    case OffencesAgainstThePerson = 'offences against the person';
    case CriminalOffence = 'criminal offence';
    case SummaryOffence = 'summary offence';
    case SexualOffence = 'sexual offence';
    case Larceny = 'larceny';


    public function getLabel(): ?string
    {
        return match ($this) {
            self::OffencesAgainstThePerson => 'Offences Against The Person',
            self::CriminalOffence => 'Criminal Offence',
            self::SummaryOffence => 'Summary Offence',
            self::SexualOffence => 'Sexual Offences',
            self::Larceny => 'Larceny',
        };
    }
}
