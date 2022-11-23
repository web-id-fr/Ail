<?php

use Illuminate\Support\Facades\Route;
use Webid\Ail\Http\Controllers\AilController;

Route::get('/impersonate/take/{id}/{guardName?}',
    '\Lab404\Impersonate\Controllers\ImpersonateController@take')->name('impersonate');
Route::get('/impersonate/leave',
    '\Lab404\Impersonate\Controllers\ImpersonateController@leave')->name('impersonate.leave');

Route::prefix(config('ail.routes.prefix'))
    ->group(function () {
        Route::get('users/{guard?}', [AilController::class, 'index'])->name(config('ail.routes.name'));
    });
