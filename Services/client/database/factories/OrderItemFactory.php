<?php

declare(strict_type=1);

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

final class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;
    
    public function definition(): array
    {
        return [
            'product' => $this->faker->uuid(),
            'quantity' => $this->faker->numberBetween(
                int1: 1,
                int2: 10,
            ),
            'price' => $this->faker->numberBetween(
                int1: 100,
                int2: 10_000,
            ),
            'discount' => $this->faker->numberBetween(
                int1: 1,
                int2: 100,
            ),
            'order_id' => Order::factory(),
        ];
    }
}
