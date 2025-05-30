<?php

namespace Modules\Registry\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondencePriority implements HasLabel, HasIcon, HasColor, HasDescription
{
    case Flash;
    case Immediate;
    case Priority;
    case Routine;

    public function getLabel(): string
    {
        return match ($this) {
            self::Flash => 'Flash',
            self::Immediate => 'Immediate',
            self::Priority => 'Priority',
            self::Routine => 'Routine',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Flash => 'heroicon-o-exclamation',
            self::Immediate => 'heroicon-o-exclamation',
            self::Priority => 'heroicon-o-exclamation',
            self::Routine => 'heroicon-o-check-circle',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Flash => Color::Red,
            self::Immediate => Color::Orange,
            self::Priority => Color::Yellow,
            self::Routine => Color::Green,
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Flash => 'Requires immediate attention and action.',
            self::Immediate => 'Requires prompt attention and action.',
            self::Priority => 'Requires attention and action within a reasonable timeframe.',
            self::Routine => 'Standard correspondence with no immediate urgency.',
        };}

}
