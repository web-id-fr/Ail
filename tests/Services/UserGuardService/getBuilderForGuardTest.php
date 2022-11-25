<?php

use Webid\Ail\Services\Interfaces\SearchInterface;
use Webid\Ail\Services\UserGuardService;

/** @var UserGuardService $service */
$service = app(UserGuardService::class);

it('returns builder for guard', function () use ($service) {
    $builder = $service->getBuilderForGuard('customers');

    expect($builder)->toBeInstanceOf(SearchInterface::class);
});
