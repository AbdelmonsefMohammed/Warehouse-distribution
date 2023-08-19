<?php

declare( strict_types = 1);

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\ModelResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class ShowController
{
    
    public function __invoke(Request $request, string $ulid) : Responsable
    {
        $product = Product::query()->findOrFail(
            id: $ulid,
        );

        if (! $product) 
        {
            throw new ModelNotFoundException(
                message: "No product for ID: [$ulid]",
            ); 
        }

        return new ModelResponse(
            data: new ProductResource(
                resource: $product,
            ),
        );
    }
}
