<?php

use function Pest\Laravel\get;

it('can index page without specified guard', function () {
    get(route('debug-impersonate'))
        ->assertStatus(200);
});

it('can index page with guard existing', function () {
    get(route('debug-impersonate', ['guard' => 'customers']))
        ->assertStatus(200);
});

it('cannot index page with guard unknown', function () {
    get(route('debug-impersonate', ['guard' => 'unknown']))
        ->assertNotFound();
});

it('cannot index page in unallowed env', function () {
    config()->set('app.env', 'production');

    get(route('debug-impersonate'))
        ->assertUnauthorized();
});
