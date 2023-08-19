<?php

declare( strict_types = 1);

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Services\SearchService;
use App\Responses\PaginatedResponse;
use App\Http\Resources\ProductResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class IndexController
{
    public function __construct(
        private SearchService $search,
    ) {}
    public function __invoke(Request $request) : Responsable
    {
        // add search param to query string to activate search feature

        $products = $this->search->search(
            term: $request->get('search',null),
            limit: 15,
            offset: ($request->get('page',1) - 1) * 15,
        );

        return new PaginatedResponse(
            data: new LengthAwarePaginator(
                items: $products['hits'],
                total: $products['hbHits'],
                perPage: 15,
                currentPage: $request->get('page', 1),
            ),
        );
    }
}
