<?php

use function Pest\Laravel\get;

it('can index page without specified guard', function () {
    $request = get(route('debug-impersonate'))
        ->assertStatus(200);

    $users = $request->viewData('users');
    $this->assertEquals(3, $users->count());
})->with('customers', 'admins');

it('can index page with guard existing', function () {
    $request = get(route('debug-impersonate', ['guard' => 'admins']))
        ->assertStatus(200);

    $users = $request->viewData('users');
    $this->assertEquals(2, $users->count());
})->with('customers', 'admins');

it('cannot index page with guard unknown', function () {
    get(route('debug-impersonate', ['guard' => 'unknown']))
        ->assertNotFound();
});

it('cannot index page in unallowed env', function () {
    config()->set('app.env', 'production');

    get(route('debug-impersonate'))
        ->assertUnauthorized();
});
