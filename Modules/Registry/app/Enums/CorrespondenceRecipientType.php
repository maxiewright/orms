<?php

namespace Modules\Registry\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceRecipientType: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case Action = 'action';
    case Information = 'information';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Action => 'Action',
            self::Information => 'Information',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Action => 'heroicon-o-bolt',
            self::Information => 'heroicon-o-information-circle',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Action => Color::Red,
            self::Information => Color::Blue,
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Action => 'Recipient is required to take action on this correspondence',
            self::Information => 'Correspondence is sent for information purposes only, no action required',
        };
    }
}
