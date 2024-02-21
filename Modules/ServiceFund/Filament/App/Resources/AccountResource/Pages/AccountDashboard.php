<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountDashboard extends Page
{
    use InteractsWithRecord;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'modules.service-fund.filament.resources.account-resource.pages.account-dashboard';

    protected static ?string $title = 'Dashboard';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
