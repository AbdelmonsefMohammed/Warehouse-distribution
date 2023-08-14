<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\ProductStatus;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Product extends Model
{
    use HasFactory, HasUlids, Searchable;

    protected $fillable = [
        'name',
        'status',
        'description',
        'price',
        'cost',
        'weight',
        'stock',
        'dimensions',
        'category_id',
        'supplier_id',
        'warehouse_id',
    ];

    protected $casts = [
        'status' => ProductStatus::class,
        'dimensions' => AsArrayObject::class,
        'price' => MoneyCast::class,
        'cost' => MoneyCast::class,
    ];

    public function category() : BelongsTo 
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id',
        ); 
    }

    public function supplier() : BelongsTo 
    {
        return $this->belongsTo(
            related: Supplier::class,
            foreignKey: 'supplier_id',
        ); 
    }

    public function warehouse() : BelongsTo 
    {
        return $this->belongsTo(
            related: Warehouse::class,
            foreignKey: 'warehouse_id',
        ); 
    }

    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with(
            'category',
            'supplier',
            'warehouse',
        );
    }

    public function toSearchableArray() : array 
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->getAttribute('name'),
            'status' => $this->getAttribute('status'),
            'description' => $this->getAttribute('description'),
            'price' => $this->getAttribute('price'),
            'cost' => $this->getAttribute('cost'),
            'weight' => $this->getAttribute('weight'),
            'stock' => $this->getAttribute('stock'),
            'dimensions' => $this->getAttribute('dimensions'),
            'category' => [
                'name' => $this->category->getAttribute('name')
            ],
            'supplier' => [
                'name' => $this->supplier->getAttribute('name'),
                'referance' => $this->supplier->getAttribute('referance'),
            ],
            'warehouse' => [
                'name' => $this->warehouse->getAttribute('name')
            ],
    
        ]; 
    }
}
