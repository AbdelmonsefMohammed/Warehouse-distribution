<?php

declare( strict_types = 1);

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Order $resource
 */
final class OrderResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,  
            'status' => $this->resource->status->value,
            'weight' => $this->resource->weight,
            'count' => $this->resource->items->count(),
            'items' => OrderItemResource::collection(
                resource: $this->whenLoaded(
                    relationship: 'items'    
                ),
            ),
            'client' => new ClientResource(
                resource: $this->whenLoaded(
                    relationship: 'client',
                )
            )
        ];
    }
}
