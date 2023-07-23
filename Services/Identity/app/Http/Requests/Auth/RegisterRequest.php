<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name'      =>  ['required','string','min:3','max:255'],
            'email'     =>  ['required','email','max:255',Rule::unique('users','email')],
            'password'  =>  ['required','string',Password::default()]
        ];
    }
}
