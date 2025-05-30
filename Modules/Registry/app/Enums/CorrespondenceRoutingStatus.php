<?php

namespace Modules\Registry\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceRoutingStatus: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case PendingAttention = 'pending_attention';
    case Viewed = 'viewed';
    case BeingActioned = 'being_actioned';
    case Actioned = 'actioned';
    case Forwarded = 'forwarded';
    case Returned = 'returned';

//(e.g., Pending Dispatch, Dispatched, Pending Receipt, Received, With CO, CO Action Captured, Actioned, Forwarded, Returned, Awaiting Collection, Action Complete, Filed).

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PendingAttention => __('Pending Attention'),
            self::Viewed => __('Viewed'),
            self::BeingActioned => __('Being Actioned'),
            self::Actioned => __('Actioned'),
            self::Forwarded => __('Forwarded'),
            self::Returned => __('Returned'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PendingAttention => 'heroicon-o-exclamation',
            self::Viewed => 'heroicon-o-eye',
            self::BeingActioned => 'heroicon-o-cog',
            self::Actioned => 'heroicon-o-check',
            self::Forwarded => 'heroicon-o-arrow-right',
            self::Returned => 'heroicon-o-arrow-left',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PendingAttention => 'warning',
            self::Viewed => 'info',
            self::BeingActioned => 'primary',
            self::Actioned => 'success',
            self::Forwarded => 'secondary',
            self::Returned => 'danger',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::PendingAttention => 'Awaiting attention from the recipient.',
            self::Viewed => 'The correspondence has been viewed.',
            self::BeingActioned => 'Currently being acted upon.',
            self::Actioned => 'The action has been completed.',
            self::Forwarded => 'Forwarded to another party.',
            self::Returned => 'Returned to the sender.',
        };
    }
}
