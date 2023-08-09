<?php

declare(strict_type=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class OrderItem extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'product',
        'quantity',
        'price',
        'discount',
        'order_id',
    ];

    public function order() : BelongsTo 
    {
        return $this->belongsTo(
            related: Order::class,
            foreignKey: 'order_id',
        );
    }
}
