<?php

namespace Modules\Legal\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class LegalPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Legal';
    }

    public function getId(): string
    {
        return 'legal';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
