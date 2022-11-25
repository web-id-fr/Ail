<?php

namespace Webid\Ail\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Webid\Ail\AilServiceProvider;
use Webid\Ail\Services\SearchUser;
use Webid\Ail\Tests\Models\Admin;
use Webid\Ail\Tests\Models\Customer;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Webid\\Ail\\Tests\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    public function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $this->setDefaultConfig();

        include_once __DIR__.'/Database/migrations/create_admins_table.php';
        include_once __DIR__.'/Database/migrations/create_customers_table.php';

        (new \CreateAdminsTable())->up();
        (new \CreateCustomersTable())->up();
    }

    protected function getPackageProviders($app): array
    {
        return [
            AilServiceProvider::class,
        ];
    }

    protected function setDefaultConfig(): void
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        config()->set('auth.defaults', [
            'guard' => 'customers',
            'passwords' => 'users',
        ]);
        config()->set('auth.guards', [
            'customers' => [
                'driver' => 'session',
                'provider' => 'customers',
            ],
            'admins' => [
                'driver' => 'session',
                'provider' => 'admins',
            ],
            'error-database' => [
                'driver' => 'session',
                'provider' => 'error-database',
            ],
            'error-model' => [
                'driver' => 'session',
                'provider' => 'error-model',
            ],
        ]);
        config()->set('auth.providers', [
            'customers' => [
                'driver' => 'eloquent',
                'model' => Customer::class,
            ],
            'admins' => [
                'driver' => 'eloquent',
                'model' => Admin::class,
            ],
            'error-database' => [
                'driver' => 'database',
                'model' => Customer::class,
            ],
            'error-model' => [
                'driver' => 'eloquent',
                'model' => null,
            ],
        ]);
        config()->set('ail', [
            'routes' => [
                'prefix' => 'debug-impersonate',
                'name' => 'debug-impersonate',
                'middlewares' => [
                    'web',
                ],
            ],
            'guards' => [
                'customers' => SearchUser::class,
                'admins' => SearchUser::class,
                'error-database' => SearchUser::class,
                'error-model' => SearchUser::class,
            ],
            'allowedEnv' => [
                'local',
                'preproduction',
                'testing',
            ],
            'perPage' => 15,
        ]);
    }
}
