<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\TransactionType;

class LatestAccountTransactions extends BaseWidget
{
    public Account $account;


    public function getTableRecordTitle(Model $record): ?string
    {
        return "Latest Transactions for {$this->account->name}";
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query()
                ->where('account_id', $this->account->id))
//                ->whereDate('executed_at', '>=', now()->subMonth()))
            ->columns([
                TextColumn::make('executed_at')
                    ->label('Date'),
                TextColumn::make('amount')
                    ->color(fn ($record) => $record->type === TransactionType::Debit ? 'success' : 'danger')
                    ->money(config('servicefund.currency')),

            ]);
    }
}
