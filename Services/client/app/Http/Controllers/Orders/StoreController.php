<?php

declare(strict_types=1);

namespace App\Http\Controllers\Orders;

use Treblle\Tools\Http\Enums\Status;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Cache;
use App\Commands\Orders\CreateNewOrder;
use App\Queries\Orders\FetchClientByUlid;
use App\Http\Requests\Orders\StoreRequest;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\ModelResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


final readonly class StoreController
{
    public function __construct(
        private FetchClientByUlid $query,
        private CreateNewOrder $command,
    ) {}
    public function __invoke(StoreRequest $request, string $ulid) : Responsable
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
        $order = $this->command->handle(
            ulid: $client->getKey(),
        );

        // set as default order for client
        Cache::forever(
            key: $client->getKey() . '_active_order',
            value: $order->getKey(),
        );

        return new ModelResponse(
            data: new OrderResource(
                resource: $order,
            ),
            status: Status::CREATED,
        );
    }
}
