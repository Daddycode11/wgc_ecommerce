<?php

namespace Botble\Raffle\Tables;

use Botble\Raffle\Models\Raffle;
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

class RaffleTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Raffle::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('raffle.create'))
            ->addActions([
                EditAction::make()->route('raffle.edit'),
                DeleteAction::make()->route('raffle.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                NameColumn::make(),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('raffle.destroy'),
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
