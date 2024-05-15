<?php

namespace Modules\Legal\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum InterdictionStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';

    case Interdicted = 'interdicted';

    case Lifted = 'lifted';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Interdicted => 'Interdicted',
            self::Lifted => 'Lifted',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Interdicted => 'danger',
            self::Lifted => 'success',
        };
    }
}
