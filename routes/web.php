<?php

use Illuminate\Support\Facades\Route;
use Webid\Ail\Http\Controllers\AilController;
use Webid\Ail\Http\Controllers\ImpersonateController;

Route::prefix(config('ail.routes.prefix'))
    ->name(config('ail.routes.name') . '.')
    ->group(function () {
        Route::get('impersonate/take/{id}/{guardName?}', [ImpersonateController::class, 'take'])
            ->name('impersonate');
        Route::get('impersonate/leave', [ImpersonateController::class, 'leave'])
            ->name('impersonate.leave');
        Route::get('{guard?}', [AilController::class, 'index'])
            ->name('index');
    });
