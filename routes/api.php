<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use Theme\Farmart\Http\Controllers\FarmartController;

Route::post('/add-money-to-wallet', [FarmartController::class, 'addAmmount'])->name('add-money-to-wallet');
Route::get('/get-wallet-amount', [FarmartController::class, 'getAmount'])->name('get-wallet-amount');
Route::post('/bid', [LandingPageController::class, "Bid"])->name('Bid');
Route::post('/update-bid-winner', [LandingPageController::class, "UpdateBidWinner"])->name('UpdateBidWinner');
Route::post('/join-raffle', [LandingPageController::class, "JoinRaffle"])->name('JoinRaffle');

