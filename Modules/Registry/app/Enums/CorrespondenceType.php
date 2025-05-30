<?php

namespace Modules\Registry\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceType: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case Routine = 'routine';
    case DemiOfficial = 'demi_official';
    case LooseMinute = 'loose_minute';
    case Memoranda = 'memoranda';
    case LetterToCivilian = 'letter_to_civilian';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Routine => 'Routine',
            self::DemiOfficial => 'Demi Official',
            self::LooseMinute => 'Loose Minute',
            self::Memoranda => 'Memoranda',
            self::LetterToCivilian => 'Letter To Civilian',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Routine => 'heroicon-o-document-text',
            self::DemiOfficial => 'heroicon-o-document',
            self::LooseMinute => 'heroicon-o-clipboard',
            self::Memoranda => 'heroicon-o-clipboard-document-list',
            self::LetterToCivilian => 'heroicon-o-envelope',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Routine => Color::Blue,
            self::DemiOfficial => Color::Indigo,
            self::LooseMinute => Color::Emerald,
            self::Memoranda => Color::Amber,
            self::LetterToCivilian => Color::Purple,
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Routine => 'Standard official correspondence between military units or departments',
            self::DemiOfficial => 'Semi-formal correspondence often between officers of similar rank',
            self::LooseMinute => 'Internal document for quick communication within a unit or department',
            self::Memoranda => 'Formal internal document for distributing information or instructions',
            self::LetterToCivilian => 'Formal correspondence addressed to civilian individuals or organizations',
        };
    }
}
