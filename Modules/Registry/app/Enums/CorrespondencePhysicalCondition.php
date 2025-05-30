<?php

namespace Modules\Registry\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondencePhysicalCondition: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case New = 'new';
    case Good = 'good';
    case Fair = 'fair';
    case Poor = 'poor';
    case Damaged = 'damaged';
    case Unusable = 'unusable';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::New => 'New',
            self::Good => 'Good',
            self::Fair => 'Fair',
            self::Poor => 'Poor',
            self::Damaged => 'Damaged',
            self::Unusable => 'Unusable',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::New => 'heroicon-o-sparkles',
            self::Good => 'heroicon-o-check-circle',
            self::Fair => 'heroicon-o-check',
            self::Poor => 'heroicon-o-exclamation-circle',
            self::Damaged => 'heroicon-o-exclamation-triangle',
            self::Unusable => 'heroicon-o-x-circle',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::New => 'success',
            self::Good => 'success',
            self::Fair => 'warning',
            self::Poor => 'warning',
            self::Damaged => 'danger',
            self::Unusable => 'danger',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::New => 'Item is in new or like-new condition',
            self::Good => 'Item is in good condition with minimal wear',
            self::Fair => 'Item shows signs of use but is fully functional',
            self::Poor => 'Item has significant wear and may have minor issues',
            self::Damaged => 'Item has damage that affects functionality',
            self::Unusable => 'Item is severely damaged and cannot be used',
        };
    }
}
