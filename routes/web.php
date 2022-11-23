<?php

use Illuminate\Support\Facades\Route;
use Webid\Ail\Http\Controllers\AilController;

Route::prefix(config('ail.routes.prefix'))
    ->group(function () {
        Route::get('users/{guard?}', [AilController::class, 'index'])->name(config('ail.routes.name'));
    });
