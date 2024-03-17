<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\Filament\App\Clusters\Metadata\Resources\AccountResource\Widgets\AccountCashFlowChart;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountDashboard extends Page implements HasActions, HasForms
{
    use HasPageSidebar;
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'servicefund::filament.resources.account-resource.pages.account-dashboard';

    protected static ?string $title = 'Dashboard';

    public Account $record;

    protected function getHeaderWidgets(): array
    {
        return [
            AccountResource\Widgets\AccountOverview::make([
                'balance' => $this->record->balance,
                'debits' => $this->record->debits,
                'credits' => $this->record->credits,
            ]),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AccountCashFlowChart::make(['account' => $this->record]),
            AccountResource\Widgets\LatestAccountTransactions::make(['account' => $this->record]),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
