<?php

declare( strict_types = 1);

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\Launchpad\Http\Responses\CollectionResponse;

final class IndexController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : Responsable
    {
        // add search param to query string to activate search feature
        return new CollectionResponse(
            data: ProductResource::collection(
                resource: Product::search(
                    query: $request->get('search',''),
                )->paginate(),
            ),
        );
    }
}
