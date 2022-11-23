<?php

use Webid\Ail\Exceptions\GuardUnauthorized;
use Webid\Ail\Exceptions\ProviderDriverException;
use Webid\Ail\Exceptions\ProviderModelException;
use Webid\Ail\Services\UserGuardService;
use Webid\Ail\Tests\Models\Admin;
use Webid\Ail\Tests\Models\Customer;

/** @var UserGuardService $service */
$service = app(UserGuardService::class);

it('throws exception with unknown guard', function () use ($service) {
    $service->getModelForGuard('unknown');
})->throws(GuardUnauthorized::class);

it('throws exception with wrong driver', function () use ($service) {
    $service->getModelForGuard('error-database');
})->throws(ProviderDriverException::class);

it('throws exception with wrong model', function () use ($service) {
    $service->getModelForGuard('error-model');
})->throws(ProviderModelException::class);

it('returns model', function () use ($service) {
    $customer = $service->getModelForGuard('customers');
    $admin = $service->getModelForGuard('admins');

    expect($customer::class)->toEqual(Customer::class)
        ->and($admin::class)->toEqual(Admin::class);
});
