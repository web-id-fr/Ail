<?php

use Webid\Ail\Services\UserGuardService;

/** @var UserGuardService $service */
$service = app(UserGuardService::class);

it('returns provider for guard', function () use ($service) {
    $provider = $service->getProviderForGuard('customers');

    expect($provider)->toEqual('customers');
});
