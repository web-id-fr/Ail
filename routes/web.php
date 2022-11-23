<?php

use Illuminate\Support\Facades\Route;
use Webid\Ail\Http\Controllers\AilController;
use Webid\Ail\Http\Controllers\ImpersonateController;
use Webid\Ail\Http\Middleware\CanImpersonate;
use Webid\Ail\Http\Middleware\IsImpersonating;

Route::prefix(config('ail.routes.prefix'))
    ->middleware(config('ail.routes.middlewares', []))
    ->name(config('ail.routes.name').'.')
    ->group(function () {
        Route::get('impersonate/take/{id}/{guardName?}', [ImpersonateController::class, 'take'])
            ->name('impersonate')
            ->middleware([
                CanImpersonate::class,
            ]);
        Route::get('impersonate/leave', [ImpersonateController::class, 'leave'])
            ->name('impersonate.leave')
            ->middleware([
                IsImpersonating::class,
            ]);
        Route::get('{guard?}', [AilController::class, 'index'])
            ->name('index');
    });
