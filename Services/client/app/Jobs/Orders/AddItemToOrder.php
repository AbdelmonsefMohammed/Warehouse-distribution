<?php

declare( strict_types = 1);

namespace App\Jobs\Orders;

use App\Models\Order;
use App\Models\Client;
use Brick\Money\Money;
use App\Models\OrderItem;
use App\Enums\OrderStatus;
use Illuminate\Bus\Queueable;
use InvalidArgumentException;
use App\Services\CatalogService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use JustSteveKing\Launchpad\Database\Portal;
use Illuminate\Contracts\Queue\ShouldBeUnique;

final class AddItemToOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public readonly string $client,
        public readonly string $order,
        public readonly string $product,
        public readonly int $quantity,
        public readonly int $discount,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(CatalogService $service, Portal $database): void
    {
        if(! Client::query()->where('id', $this->client)->exists())
        {
            throw new InvalidArgumentException(
                message: "Client does not exist: [$this->client]",
            );
        }

        $order = Order::query()->find(
            id: $this->order,
        );

        if (! $order) 
        {
            $order = Order::query()->create(
                attributes: [
                    'status' => OrderStatus::DRAFT,
                    'client_id' => $this->client,
                ],
            );
            
        }

        // check that the product exsists.
        $item = $service->lookup($this->product);
        if(! $item)
        {
            throw new InvalidArgumentException(
                message: "Invalid product ID passed: [$this->product]",
            );
        }

        // add order item to database
        $exists = OrderItem::query()->where('product', $this->product)->where('order_id', $this->order)->firstOrFail();

        if($exists)
        {
            $exists->update([
                'quantity' => $this->quantity + $exists->quantity,
                'price' => $exists->price + Money::of(
                                    amount: $item['price']['amount'],
                                    currency: $item['price']['currency'],
                                )->getAmount()->toInt(),
            ]);
        }else{
            $database->transaction(
                callback: fn () => OrderItem::query()->create(
                    attributes: [
                        'product' => $this->product,
                        'quantity' => $this->quantity,
                        'price' => Money::of(
                            amount: $item['price']['amount'],
                            currency: $item['price']['currency'],
                        )->getAmount()->toInt(),
                        'discount' => $this->discount,
                        'order_id' => $this->order,
                    ],
                ),
            );
        }
        

        // update order to include new weight

        $database->transaction(
            callback: fn () => $order->increment(
                'weight',
                $item['weight'] * $this->quantity,
            ),
        );
    }
}
