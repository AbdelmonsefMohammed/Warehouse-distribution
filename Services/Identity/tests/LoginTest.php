<?php

declare(strict_types=1);

use Treblle\Tools\Http\Enums\Status;
use App\Http\Controllers\Auth\LoginController;
use function Pest\Laravel\PostJson;

it('validates the users input', function () : void {
    postJson(
        uri: action(LoginController::class),
        data: [],
    )->assertStatus(
        status: Status::UNPROCESSABLE_CONTENT->value,
    )->assertJsonValidationErrorFor(
        key: 'email',
    )->assertJsonValidationErrorFor(
        key: 'password',
    );
});

todo('it returns the correct status if the credentials are incorrect');

todo('it will store an access token on cache');

todo('it will return the access code in the response');