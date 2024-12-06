<?php

namespace Modules\Legal\Enums\LegalAction;

use Filament\Support\Contracts\HasLabel;

enum LitigationStatus: string implements HasLabel
{
    case Pleadings = 'pleadings';
    case Discovery = 'discovery';
    case Motion = 'motion';
    case Trial = 'trial';
    case Verdict = 'verdict';
    case Appeal = 'appeal';



//'pending', 'active', 'settled', 'dismissed', 'judgment issued'

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pleadings => 'Pleadings',
            self::Discovery => 'Discovery',
            self::Motion => 'Motion',
            self::Trial => 'Trial',
            self::Verdict => 'Verdict',
            self::Appeal => 'Appeal',
        };
    }
}
