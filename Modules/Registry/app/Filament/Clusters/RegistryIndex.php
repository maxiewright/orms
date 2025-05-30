<?php

namespace Modules\Registry\Filament\Clusters;

use Filament\Clusters\Cluster;
use Nwidart\Modules\Facades\Module;

class RegistryIndex extends Cluster
{
    protected static ?string $navigationGroup = 'Registry';

    public static function getModuleName(): string
    {
        return 'Registry';
    }

    public static function getModule(): \Nwidart\Modules\Module
    {
        return Module::findOrFail(static::getModuleName());
    }

    public static function getNavigationLabel(): string
    {
        return __('Registry Index');
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-squares-2x2';
    }
}
