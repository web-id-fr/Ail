<?php

use Webid\Ail\Tests\Models\Admin;

dataset('admins', function () {
    yield fn () => Admin::factory()
        ->count(2)
        ->sequence(fn ($sequence) => ['name' => 'Admin '. $sequence->index])
        ->create();
});
