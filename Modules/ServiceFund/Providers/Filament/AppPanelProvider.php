<?php

namespace Modules\ServiceFund\Providers\Filament;

use App\Filament\Resources\InterviewResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    private string $module = 'ServiceFund';

    public function panel(Panel $panel): Panel
    {
        $moduleNamespace = $this->getModuleNamespace();

        return $panel
            ->id('service-fund')
            ->path('service-fund')
            ->login()
            ->colors([
                'primary' => Color::Teal,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Banking')
                    ->icon('heroicon-o-currency-dollar'),
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->navigationItems([
                NavigationItem::make('Home')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->url('../admin/servicepeople'),
            ])
            ->discoverResources(in: module_path($this->module, 'Filament/App/Resources'), for: "$moduleNamespace\\Filament\\App\\Resources")
            ->discoverPages(in: module_path($this->module, 'Filament/App/Pages'), for: "$moduleNamespace\\Filament\\App\\Pages")
            ->discoverClusters(in: module_path($this->module, 'Filament/App/Clusters'), for: "$moduleNamespace\\Filament\\App\\Clusters")
            ->pages([])
            ->discoverWidgets(in: module_path($this->module, 'Filament/App/Widgets'), for: "$moduleNamespace\\Filament\\App\\Widgets")
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    protected function getModuleNamespace(): string
    {
        return config('modules.namespace').'\\'.$this->module;
    }
}
