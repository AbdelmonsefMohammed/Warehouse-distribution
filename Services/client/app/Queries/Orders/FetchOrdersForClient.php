<?php

declare( strict_types = 1);

namespace App\Queries\Orders;

use App\Models\Order;
use Illuminate\Support\Collection;

final class FetchOrdersForClient
{
    public function handle(string $ulid, array $inlude = []) : Collection 
    {
        return Order::query()->with($include)->where('client_id', $ulid)->get();
    }
}