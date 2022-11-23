<?php

namespace Webid\Ail\Tests\Database\Factories;

use Webid\Ail\Tests\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => 'password',
        ];
    }
}
