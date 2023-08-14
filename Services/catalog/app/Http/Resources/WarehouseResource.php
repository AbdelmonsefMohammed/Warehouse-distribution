<?php

declare( strict_types = 1);

namespace App\Http\Resources;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Warehouse $resource
 */
final class WarehouseResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'name' => $this->resource->name,
            'manager' => $this->resource->manager,
            'email' => $this->resource->email,
            'status' => $this->resource->status,
            'address' => $this->resource->address,
    
        ];
    }
}
