<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasLabel;

enum CourtAppearanceReason: string implements HasLabel
{
    case Arraignment = 'arraignment';
    case Hearing = 'hearing';
    case Trial = 'trial';
    case Sentencing = 'sentencing';
    case BailHearing = 'bail hearing';
    case ProbationHearing = 'probation hearing';
    case Appeal = 'appeal';
    case FamilyCourtMatter = 'family court matter';
    case StatusConference = 'status conference';
    case Mediation = 'mediation';
    case CivilLitigation = 'civil litigation';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Arraignment => 'Arraignment',
            self::Hearing => 'Hearing',
            self::Trial => 'Trial',
            self::Sentencing => 'Sentencing',
            self::BailHearing => 'Bail Hearing',
            self::ProbationHearing => 'Probation Hearing',
            self::Appeal => 'Appeal',
            self::FamilyCourtMatter => 'Family Court Matter',
            self::StatusConference => 'Status Conference',
            self::Mediation => 'Mediation',
            self::CivilLitigation => 'Civil Litigation',
        };
    }
}
