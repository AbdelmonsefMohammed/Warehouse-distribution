<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Treblle\Tools\Http\Enums\Status;
use Illuminate\Contracts\Auth\Factory;
use App\Services\AuthenticationService;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\MessageResponse;

final readonly class LoginController
{
    public function __construct(
        private Factory $auth,
        private AuthenticationService $service, 
    ) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request) : Responsable
    {
        if (! $this->auth->guard()->attempt($request->only(['email','password']))) {
            throw new AuthenticationException(
                message:"Invalid credentials",
                code: Status::UNPROCESSABLE_CONTENT->value,
            );
        }

        $token = $this->service->createAccessToken(
            user: $this->auth->guard()->user(),
        );

        return new MessageResponse(
            data: [
                'message' => $token,
            ],
        );
    }
}
