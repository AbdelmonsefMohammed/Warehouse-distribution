<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email'     =>  ['required','email','max:255'],
            'password'  =>  ['required','string']
        ];
    }
}
