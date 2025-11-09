<?php

use Illuminate\Support\Facades\Route;
use Botble\Bidding\Http\Controllers\BiddingSystemController;

Route::group(['namespace' => 'Botble\Bidding\Http\Controllers', 'middleware' => ['web', 'auth']], function () {
    Route::prefix('admin/bidding-system')->group(function () {

        Route::get('/', [BiddingSystemController::class, 'index'])
            ->name('bidding-system.index');

        Route::get('/create', [BiddingSystemController::class, 'create'])
            ->name('bidding-system.create');

        Route::post('/store', [BiddingSystemController::class, 'store'])
            ->name('bidding-system.store');

        Route::get('/{bidding_system}/edit', [BiddingSystemController::class, 'edit'])
            ->name('bidding-system.edit');

        Route::put('/{bidding_system}/update', [BiddingSystemController::class, 'update'])
            ->name('bidding-system.update');

        Route::delete('/{bidding_system}', [BiddingSystemController::class, 'destroy'])
            ->name('bidding-system.destroy');
    });
});
