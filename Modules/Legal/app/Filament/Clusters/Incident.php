<?php

namespace Modules\Legal\Filament\Clusters;

use Filament\Clusters\Cluster;
use Nwidart\Modules\Facades\Module;

class Incident extends Cluster
{
    protected static ?string $navigationGroup = 'Ancillary';
    public static function getModuleName(): string
    {
        return 'Legal';
    }

    public static function getModule(): \Nwidart\Modules\Module
    {
        return Module::findOrFail(static::getModuleName());
    }

    public static function getNavigationLabel(): string
    {
        return __('Incident');
    }

}
