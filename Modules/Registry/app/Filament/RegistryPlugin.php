<?php

namespace Modules\Registry\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class RegistryPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Registry';
    }

    public function getId(): string
    {
        return 'registry';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
