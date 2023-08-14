<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProductFactory extends Factory
{
    protected $model = Product::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'status' => ProductStatus::IN_STOCK,
            'description' => $this->faker->paragraph(),
            'price' => $price = $this->faker->numberBetween(
                int1: 1_000,
                int2: 10_000,  
            ),
            'cost' => $cost  =round(
                num: ($price / 100) * 65,
            ),
            'weight' =>  $this->faker->numberBetween(
                int1: 1_000,
                int2: 5_000,  
            ),
            'stock' => 50,
            'dimensions' =>  [
                'height' => 5,
                'width' => 5,
                'depth' => 5,
            ],
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'warehouse_id' => Warehouse::factory,
        ];
    }
}
