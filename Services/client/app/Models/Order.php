<?php

declare( strict_types = 1);

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read string $id
 * @property-read OrderStatus $status
 * @property-read int $weight
 */
final class Order extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'status',
        'c',
        'shipping',
        'billing',
        'client_id',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'shipping' => AsArrayObject::class,
        'billing' => AsArrayObject::class,
    ];

    public function client() : BelongsTo 
    {
        return $this->belongsTo(
            related: Client::class,
            foreignKey: 'client_id',
        ); 
    }

    public function items() : HasMany 
    {
        return $this->hasMany(
            related: OrderItem::class,
            foreignKey: 'order_id',
        ); 
    }
}
