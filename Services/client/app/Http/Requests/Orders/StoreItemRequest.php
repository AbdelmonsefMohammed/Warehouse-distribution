<?php

declare( strict_types = 1);

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

final class StoreItemRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'product' => ['required','string'],
            'quantity' => ['required','integer'],
            'discount' => ['nullable','integer','min:0','max:100'],

        ];
    }
}
