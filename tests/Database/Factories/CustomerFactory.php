<?php

namespace Webid\Ail\Tests\Database\Factories;

use Webid\Ail\Tests\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => 'password',
        ];
    }
}
