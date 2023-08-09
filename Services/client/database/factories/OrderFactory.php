<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use App\Models\Client;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

final class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'status' => OrderStatus::DRAFT,
            'weight' => $this->faker->numberBetween(
                int1: 100,
                int2: 10_000
            ),
            'shipping' => [
                'company' => $this->faker->company(),
                'address' => $this->faker->address(),
            ],
            'billing' => [
                'company' => $this->faker->company(),
                'address' => $this->faker->address(),
            ],
            'client_id' => Client::factory(),
        ];
    }
}
