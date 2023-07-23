<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Throwable;
use Illuminate\Support\Facades\Hash;
use Treblle\Tools\Http\Enums\Status;
use App\Services\AuthenticationService;
use App\Exceptions\AuthenticationException;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\MessageResponse;


final readonly class RegisterController
{
    
    public function __construct(
        private AuthenticationService $service
    ) {}

    public function __invoke(RegisterRequest $request): Responsable
    {
        
        try {
            
            $user = $this->service->createUser(
                data: [
                    'name'      => $request->string('name')->toString(),
                    'email'     => $request->string('email')->toString(),
                    'password'  => Hash::make(
                        $request->string('password')->toString()
                    ),
                ]
            );
             
        } catch (Throwable $exception) {
            throw new AuthenticationException(
                message:"Failed to create user account.",
                code: Status::INTERNAL_SERVER_ERROR->value,
                previous: $exception,
            );
        }

        return new MessageResponse(
            data: [
                'message' => $this->service->createAccessToken(
                    user: $user,
                ),
            ],
            status: Status::CREATED,
        );
    }
}
