<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasLabel;

enum LegalProfessionalType: string implements HasLabel
{
    case Judge = 'judge';

    case Magistrate = 'magistrate';

    case Lawyer = 'lawyer';

    case Prosecutor = 'prosecutor';


    public function getLabel(): ?string
    {
        return match ($this) {
            self::Judge => 'Judge',
            self::Magistrate => 'Magistrate',
            self::Lawyer => 'Lawyer',
            self::Prosecutor => 'Prosecutor',
        };
    }
}