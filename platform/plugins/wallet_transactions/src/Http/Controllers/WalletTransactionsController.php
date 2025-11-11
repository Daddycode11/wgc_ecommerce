<?php

namespace Botble\WalletTransactions\Http\Controllers;

use App\Models\Wallet;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\WalletTransactions\Http\Requests\WalletTransactionsRequest;
use Botble\Base\Http\Controllers\BaseController;
use Botble\WalletTransactions\Tables\WalletTransactionsTable;
use Botble\WalletTransactions\Forms\WalletTransactionsForm;
use Botble\WalletTransactions\Models\WalletTransactions;

class WalletTransactionsController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/wallet_transactions::wallet_transactions.name')), route('wallet_transactions.index'));
    }

    public function index(WalletTransactionsTable $table)
    {
        $this->pageTitle(trans('plugins/wallet_transactions::wallet_transactions.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/wallet_transactions::wallet_transactions.create'));

        return WalletTransactionsForm::create()->renderForm();
    }

    public function store(WalletTransactionsRequest $request)
    {
        $form = WalletTransactionsForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('wallet_transactions.index'))
            ->setNextUrl(route('wallet_transactions.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(WalletTransactions $walletTransactions)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', [
            'wallet_id' => $walletTransactions->wallet_id,
            'amount' => $walletTransactions->amount,
            'description' => $walletTransactions->description,
            'reference' => $walletTransactions->reference,
            'status' => $walletTransactions->status,
        ]));
        if($walletTransactions->status == "added"){
            Wallet::where('id', $walletTransactions->wallet_id)->increment('balance', $walletTransactions->amount);
        }

        return WalletTransactionsForm::createFromModel($walletTransactions)->renderForm();
    }

    public function update(WalletTransactions $walletTransactions, WalletTransactionsRequest $request)
    {
        WalletTransactionsForm::createFromModel($walletTransactions)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('wallet_transactions.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(WalletTransactions $walletTransactions)
    {
        return DeleteResourceAction::make($walletTransactions);
    }
}
