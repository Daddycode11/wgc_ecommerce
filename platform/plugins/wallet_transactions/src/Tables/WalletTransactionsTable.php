<?php

namespace Botble\WalletTransactions\Tables;

use Botble\WalletTransactions\Models\WalletTransactions;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class WalletTransactionsTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(WalletTransactions::class)
            // ->addHeaderAction(CreateHeaderAction::make()->route('wallet_transactions.create'))
            ->addActions([
                EditAction::make()->route('wallet_transactions.edit'),
                DeleteAction::make()->route('wallet_transactions.destroy'),
            ])
            ->addColumns([
                IdColumn::make('id')->sortable(),
                Column::make('wallet_id')->sortable()->searchable(),
                Column::make('amount')->sortable()->searchable(),
                Column::make('description')->sortable()->searchable(),
                Column::make('reference')->sortable()->searchable(),
                Column::make('status')->sortable()->searchable(),
                CreatedAtColumn::make('created_at')->sortable(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                   'id','wallet_id', 'amount', 'description', 'reference', 'status', 'created_at'
                ]);
            });
    }
}
