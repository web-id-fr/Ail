<?php

namespace Webid\Ail\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webid\Ail\Tests\Models\Admin;

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
