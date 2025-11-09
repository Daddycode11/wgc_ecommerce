<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper;

Route::group(['namespace' => 'Botble\Raffle\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'raffles', 'as' => 'raffle.'], function () {
            Route::resource('', 'RaffleController')->parameters(['' => 'raffle']);
        });
    });
});
