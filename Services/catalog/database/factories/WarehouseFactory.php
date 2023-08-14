<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

final class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city() . 'warehouse',
            'manager' => $this->faker->name(),
            'email' => $this->faker->unique()->companyEmail(),
            'status' => WarehouseStatus::ONLINE,
            'address' => explode(',', $this->faker->address()),
        ];
    }
}
