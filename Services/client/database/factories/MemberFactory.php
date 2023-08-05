<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Client;
use App\Models\Member;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
final class MemberFactory extends Factory
{
   
    protected $model = Member::class;
    
    public function definition(): array
    {
        return [
            'role'  => Role::USER,
            'client_id' => Client::factory(),
            'company_id' => Company::factory(),
        ];
    }

    public function role(Role $role) : MemberFactory 
    {
        return $this->state(
            state: static fn(array $attributes): array => [
                'role'  =>  $role,
            ],
        );    
    }
}
