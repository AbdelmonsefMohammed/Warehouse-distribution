<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

final class CategoryFactory extends Factory
{
    protected $model = Category::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->catchPhrase(),
            'status' => CategoryStatus::ACTIVE,
            'description' => $this->faker->paragraph(),
        ];
    }
}
