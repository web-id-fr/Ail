<?php

use Webid\Ail\Services\UserGuardService;

/** @var UserGuardService $service */
$service = app(UserGuardService::class);

it('returns models for guard', function () use ($service) {
    $customers = $service->getUsersForGuardAndSearch('customers');
    $admins = $service->getUsersForGuardAndSearch('admins');

    expect($customers->count())->toBe(3)
        ->and($admins->count())->toBe(2);
})->with('customers', 'admins');

it('returns models for guard with per page', function () use ($service) {
    config()->set('ail.perPage', 1);
    $customers = $service->getUsersForGuardAndSearch('customers');

    expect($customers->count())->toBe(1);
})->with('customers');

it('returns models for guard with search', function () use ($service) {
    $customers = $service->getUsersForGuardAndSearch('customers', '1');

    expect($customers->count())->toBe(1);
})->with('customers');
