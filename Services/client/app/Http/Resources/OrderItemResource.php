<?php

declare( strict_types = 1);

namespace App\Http\Resources;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read OrderItem $resource
 */
final class OrderItemResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'product' => $this->resource->product,
            'quantity' => $this->resource->quantity,
            'price' => $this->resource->price,
            'discount' => $this->resource->discount,
        ];
    }
}
