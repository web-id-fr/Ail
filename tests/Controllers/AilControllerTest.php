<?php

use function Pest\Laravel\get;

$index = 'debug-impersonate.index';

//it('can index page without specified guard', function () use ($index) {
//    $request = get(route($index))
//        ->assertStatus(200);
//
//    $users = $request->viewData('users');
//    $this->assertEquals(3, $users->count());
//})->with('customers', 'admins');
//
//it('can index page with guard existing', function () use ($index) {
//    $request = get(route($index, ['guard' => 'admins']))
//        ->assertStatus(200);
//
//    $users = $request->viewData('users');
//    $this->assertEquals(2, $users->count());
//})->with('customers', 'admins');
//
//it('cannot index page with guard unknown', function () use ($index) {
//    get(route($index, ['guard' => 'unknown']))
//        ->assertNotFound();
//});
//
//it('cannot index page in unallowed env', function () use ($index) {
//    config()->set('app.env', 'production');
//
//    get(route($index))
//        ->assertUnauthorized();
//});
