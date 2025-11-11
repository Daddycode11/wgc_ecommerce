<?php

use Botble\Base\Facades\AdminHelper;
use Botble\WalletTransactions\Http\Controllers\WalletTransactionsController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'wallet_transactions', 'as' => 'wallet_transactions.'], function () {
        Route::resource('', WalletTransactionsController::class)->parameters(['' => 'wallet_transactions']);
    });
});
