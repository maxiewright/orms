<?php

namespace Modules\Legal\Enums\LegalAction;

use Filament\Support\Contracts\HasLabel;

enum PreActionProtocolStatus: string implements HasLabel
{
    case Drafting = 'drafting';
    case Sent = 'sent';
    case Received = 'received';
    case UnderReview = 'under review';
    case ResponsePending = 'response pending';
    case ExtensionGranted = 'extension granted';
    case Responded = 'responded';
    case Negotiation = 'negotiation';
    case Settlement = 'settlement';
    case ResponseOverdue = 'Response Overdue';

    case Litigation = 'litigation';
    case Closed = 'closed';
    case Withdrawn = 'withdrawn';
    case Dismissed = 'dismissed';
    case Disputed = 'disputed';
    case NonCompliance = 'non-compliance';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Drafting => 'Drafting',
            self::Sent => 'Sent',
            self::Received => 'Received',
            self::UnderReview => 'Under Review',
            self::ResponsePending => 'Response Pending',
            self::ExtensionGranted => 'Extension Granted',
            self::Responded => 'Responded',
            self::Negotiation => 'Negotiation',
            self::Settlement => 'Settlement',
            self::ResponseOverdue => 'Response Overdue',
            self::Litigation => 'Litigation',
            self::Closed => 'Closed',
            self::Withdrawn => 'Withdrawn',
            self::Dismissed => 'Dismissed',
            self::Disputed => 'Disputed',
            self::NonCompliance => 'Non-Compliance',
        };
    }
}
