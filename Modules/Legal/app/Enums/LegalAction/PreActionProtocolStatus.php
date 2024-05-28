<?php

namespace Modules\Legal\Enums\LegalAction;

use Filament\Support\Contracts\HasLabel;

enum PreActionProtocolStatus: string implements HasLabel
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
        };
    }
}
