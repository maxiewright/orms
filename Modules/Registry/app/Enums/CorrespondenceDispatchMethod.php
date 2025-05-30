<?php

namespace Modules\Registry\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceDispatchMethod: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case Email = 'email';
    case Post = 'post';
    case Fax = 'fax';
    case DispatchRider = 'dispatch_rider';
    case Courier = 'courier';
    case HandDelivered = 'hand_delivered';
    case Other = 'other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Email => 'Email',
            self::Post => 'Post',
            self::Fax => 'Fax',
            self::DispatchRider => 'Dispatch Rider',
            self::Courier => 'Courier',
            self::HandDelivered => 'Hand Delivered',
            self::Other => 'Other',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Email => 'heroicon-o-envelope',
            self::Post => 'heroicon-o-inbox',
            self::Fax => 'heroicon-o-device-phone-mobile',
            self::DispatchRider => 'heroicon-o-truck',
            self::Courier => 'heroicon-o-truck',
            self::HandDelivered => 'heroicon-o-hand-raised',
            self::Other => 'heroicon-o-question-mark-circle',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Email => 'info',
            self::Post => 'warning',
            self::Fax => 'gray',
            self::DispatchRider => 'success',
            self::Courier => 'primary',
            self::HandDelivered => 'danger',
            self::Other => 'gray',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Email => 'Sent via electronic mail',
            self::Post => 'Sent via postal service',
            self::Fax => 'Sent via facsimile',
            self::DispatchRider => 'Delivered by an official dispatch rider',
            self::Courier => 'Delivered by a courier service',
            self::HandDelivered => 'Delivered personally by hand',
            self::Other => 'Delivered by other means',
        };
    }
}
