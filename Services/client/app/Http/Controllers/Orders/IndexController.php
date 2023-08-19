<?php

declare( strict_types = 1);

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use Treblle\Tools\Http\Enums\Status;
use App\Http\Resources\OrderResource;
use App\Queries\Orders\FetchClientByUlid;
use App\Queries\Orders\FetchOrdersForClient;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\CollectionResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class IndexController
{
    public function __construct(
        private readonly FetchClientByUlid $query,
        private readonly FetchOrdersForClient $ordersQuery,
    ) {}
    public function __invoke(Request $request, string $ulid) : Responsable
    {
        $client = $this->query->handle(
            ulid: $ulid,
        );

        if (! $client) {
            throw new ModelNotFoundException(
                message: "Cannot find a client with ID: [$ulid]",
                code: Status::NOT_FOUND->value
            );
        }

        return new CollectionResponse(
            data:  OrderResource::collection(
                resource: $this->ordersQuery->handle(
                    ulid: $client->getKey(),
                    include: [
                        'client',
                        'items',
                    ],
                ),
            ),
        );
    }
}
