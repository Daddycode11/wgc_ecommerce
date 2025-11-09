<?php

namespace Botble\Bidding\Tables;

use Botble\Bidding\Models\BiddingSystem;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\Columns\NameColumn;
use Illuminate\Database\Eloquent\Builder;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;

class BiddingSystemTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(BiddingSystem::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('bidding-system.create'))
            ->addActions([
                EditAction::make()->route('bidding-system.edit'),
                DeleteAction::make()->route('bidding-system.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                NameColumn::make(),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('bidding-system.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id',
                    'name',
                    'created_at',
                    'status',
                ]);
            });
    }
}
