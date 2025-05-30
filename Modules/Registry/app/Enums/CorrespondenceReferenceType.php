<?php

namespace Modules\Registry\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceReferenceType: string implements HasLabel, HasIcon, HasColor, HasDescription
{

    case Annex = 'annex';

    case Attachment = 'attachment';

    case Supersede = 'supersede';

    case Reference = 'reference';

    case Supporting = 'supporting';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Annex => 'Annex',
            self::Attachment => 'Attachment',
            self::Supersede => 'Supersede',
            self::Reference => 'Reference',
            self::Supporting => 'Supporting',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Annex => 'heroicon-o-document-plus',
            self::Attachment => 'heroicon-o-paper-clip',
            self::Supersede => 'heroicon-o-arrow-path',
            self::Reference => 'heroicon-o-link',
            self::Supporting => 'heroicon-o-document-duplicate',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Annex => Color::Blue,
            self::Attachment => Color::Green,
            self::Supersede => Color::Orange,
            self::Reference => Color::Purple,
            self::Supporting => Color::Cyan,
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Annex => 'Additional document that provides essential information to the main correspondence',
            self::Attachment => 'Document attached to the correspondence for reference or supporting information',
            self::Supersede => 'Document that replaces or updates a previous correspondence',
            self::Reference => 'Document referenced in the correspondence but not physically attached',
            self::Supporting => 'Document that provides additional context or evidence to support the correspondence',
        };
    }
}
