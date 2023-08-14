<?php

declare( strict_types = 1);

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductResource extends JsonResource
{
    /**
     * @property-read Product $resource
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'status' => $this->resource->status,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
            'cost' => $this->resource->cost,
            'weight' => $this->resource->weight,
            'stock'  => $this->resource->stock,
            'dimensions'  => $this->resource->dimensions,
            'category' => new CategoryResource(
                resource: $this->whenLoaded('category'),
            ),
            'supplier' => new SupplierResource(
                resource: $this->whenLoaded('supplier'),
            ),
            'warehouse' => new WarehouseResource(
                resource: $this->whenLoaded('warehouse'),
            ), 
        ];
    }
}
