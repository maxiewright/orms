<?php

namespace Modules\Registry\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceAttachmentType: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case MainDocument = 'main_document';
    case Annex = 'annex';
    case Enclosure = 'enclosure';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MainDocument => 'Main Document',
            self::Annex => 'Annex',
            self::Enclosure => 'Enclosure',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::MainDocument => 'heroicon-o-document',
            self::Annex => 'heroicon-o-document-plus',
            self::Enclosure => 'heroicon-o-paper-clip',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::MainDocument => '#4A5568', // Gray
            self::Annex => '#2B6CB0', // Blue
            self::Enclosure => '#38B2AC', // Teal
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::MainDocument => 'The primary document of the correspondence.',
            self::Annex => 'An additional document that provides supplementary information.',
            self::Enclosure => 'A document included with the main correspondence.',
        };
    }
}
