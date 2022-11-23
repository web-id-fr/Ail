<?php

use Webid\Ail\Tests\Models\Customer;

dataset('customers', function () {
    yield fn () => Customer::factory()
        ->count(3)
        ->sequence(fn ($sequence) => ['name' => 'Customer '. $sequence->index])
        ->create();
});
