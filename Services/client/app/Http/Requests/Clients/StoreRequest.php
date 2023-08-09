<?php

declare( strict_types = 1);

namespace App\Http\Requests\Clients;

use Illuminate\Validation\Rule;
use App\Http\Payloads\NewClient;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required','string','min:2','max:255'],
            'email' => ['required','email',Rule::unique('clients','email')],
            'company' => ['required','string','min:2','max:255']
        ];
    }

    public function paylaod() : NewClient 
    {
        return new NewClient(
            name: $this->string('name')->toString(),
            email: $this->string('email')->toString(),
            company: $this->string('company')->toString(),
        );
    }
}
