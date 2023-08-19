<?php

declare( strict_types = 1);

namespace App\Http\Controllers\Orders\Items;

use App\Jobs\Orders\AddItemToOrder;
use Treblle\Tools\Http\Enums\Status;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Requests\Orders\StoreItemRequest;
use Treblle\Tools\Http\Responses\MessageResponse;
use JustSteveKing\Launchpad\Queue\DispatchableCommandBus;

final readonly class StoreController
{
    public function __construct(
        private DispatchableCommandBus $bus,
    ) {}

    public function __invoke(StoreItemRequest $request, string $ulid, string $order) : Responsable
    {
        $this->bus->dispatch(
            new AddItemToOrder(
                client: $ulid,
                order: $order,
                product: $request->string('product')->toString(),
                quantity: $request->integer('quantity'),
                discount: $request->integer('discount',0),
            ),
        );

        return new MessageResponse(
            data: [
                'message' => 'We are processing your request',
            ],
            status: Status::ACCEPTED
        );
    }
}
