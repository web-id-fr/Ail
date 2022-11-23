<?php

use Webid\Ail\Tests\Models\Customer;

dataset('customers', function () {
    yield fn() => Customer::factory()
        ->count(3)
        ->create();
});
