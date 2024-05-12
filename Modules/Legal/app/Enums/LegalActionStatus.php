<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasLabel;

enum LegalActionStatus: string implements HasLabel
{
    // Pre Action
    case Pending = 'pending';
    case UnderReview = 'under review';
    case Negotiation = 'negotiation';
    case Settlement = 'settlement';
    case Litigation = 'litigation';
    case Dismissed = 'dismissed';
    case Withdrawn = 'withdrawn';
    case Disputed = 'disputed';

    // Litigation

    case Pleadings = 'pleadings';
    case Discovery = 'discovery';
    case Motion = 'motion';
    case Trial = 'trial';
    case Verdict = 'verdict';
    case Appeal = 'appeal';

    public function getLabel(): ?string
    {
        return match ($this) {
            // Pre Action
            self::Pending => 'Pending',
            self::UnderReview => 'Under Review',
            self::Negotiation => 'Negotiation',
            self::Settlement => 'Settlement',
            self::Litigation => 'Litigation',
            self::Dismissed => 'Dismissed',
            self::Withdrawn => 'Withdrawn',
            self::Disputed => 'Disputed',
            // Litigation
            self::Pleadings => 'Pleadings',
            self::Discovery => 'Discovery',
            self::Motion => 'Motion',
            self::Trial => 'Trial',
            self::Verdict => 'Verdict',
            self::Appeal => 'Appeal',
        };
    }
}
