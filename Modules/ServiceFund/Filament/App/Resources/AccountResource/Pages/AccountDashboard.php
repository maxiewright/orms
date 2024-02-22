<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\Page;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountDashboard extends Page
{
    use HasPageSidebar;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'servicefund::filament.resources.account-resource.pages.account-dashboard';

    protected static ?string $title = 'Dashboard';

    public Account $record;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
        ];
    }
}
