<?php

namespace Modules\Legal\Enums;

enum CourtAppearanceOutcome: string
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

}
