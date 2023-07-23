<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DatabaseManager;

final readonly class AuthenticationService
{
    public function __construct(
        private DatabaseManager $database
    ) {}

    /**
     * @param array{name:string,email:string,password:string}
     * @return User|Model
     * @throws Throwable
     */
    public function createUser(array $data) : User|Model
    {
        return $this->database->transaction(
            callback: fn () => User::query()->create($data),
            attempts: 2,
        );
    }
    public function createAccessToken(User $user) : string 
    {
        // create api token
        $token = Str::random(40);
        // store it in cache
        Cache::put(
            key: $token,
            value: [
                'id'    => $user->getKey(),
                'role'  => $user->getAttribute('role'),
            ],
            ttl: now()->addHours(5),
        );
        // return the token

        return $token;
    }
}
