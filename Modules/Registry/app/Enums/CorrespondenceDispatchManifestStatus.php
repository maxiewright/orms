<?php

namespace Modules\Registry\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceDispatchManifestStatus: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case Preparing = 'preparing';
    case AwaitingCollection = 'awaiting_collection';
    case InTransit = 'in_transit';
    case DeliveredToOffice = 'delivered_to_office';
    case OfficeAcknowledged = 'office_acknowledged';
    case CompletedArchived = 'completed_archived';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Preparing => 'Preparing',
            self::AwaitingCollection => 'Awaiting Collection',
            self::InTransit => 'In Transit',
            self::DeliveredToOffice => 'Delivered To Office',
            self::OfficeAcknowledged => 'Office Acknowledged',
            self::CompletedArchived => 'Completed & Archived',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Preparing => 'heroicon-o-document-check',
            self::AwaitingCollection => 'heroicon-o-clock',
            self::InTransit => 'heroicon-o-truck',
            self::DeliveredToOffice => 'heroicon-o-inbox',
            self::OfficeAcknowledged => 'heroicon-o-check-badge',
            self::CompletedArchived => 'heroicon-o-archive-box',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Preparing => Color::Amber,
            self::AwaitingCollection => Color::Blue,
            self::InTransit => Color::Purple,
            self::DeliveredToOffice => Color::Emerald,
            self::OfficeAcknowledged => Color::Green,
            self::CompletedArchived => Color::Gray,
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Preparing => 'Manifest is being prepared and items are being added.',
            self::AwaitingCollection => 'Manifest is ready and awaiting collection by courier.',
            self::InTransit => 'Items have been collected and are in transit to destination.',
            self::DeliveredToOffice => 'Items have been delivered to the destination office but not yet processed.',
            self::OfficeAcknowledged => 'Destination office has acknowledged receipt of all items.',
            self::CompletedArchived => 'Delivery process is complete and manifest has been archived.',
        };
    }
}
