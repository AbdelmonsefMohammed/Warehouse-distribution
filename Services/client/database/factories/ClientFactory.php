<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;


final class ClientFactory extends Factory
{
    protected $model = Client::class;
    public function definition(): array
    {
        return [
            'name'  =>  $this->faker->name(),
            'email' => $this->faker->unique()->companyEmail(),
            'company_id' => Company::factory(),
        ];
    }
}
