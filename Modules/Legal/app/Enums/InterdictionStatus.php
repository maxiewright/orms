<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum InterdictionStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';

    case Interdicted = 'interdicted';

    case Revoked = 'revoked';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Interdicted => 'Interdicted',
            self::Revoked => 'Revoked',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Interdicted => 'danger',
            self::Revoked => 'success',
        };
    }
}
