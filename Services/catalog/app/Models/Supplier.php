<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Supplier extends Model
{
    use HasFactory, HasUlids, Notifiable;

    protected $fillable = [
        'name',
        'website',
        'email',
        'referance'
    ];

    public function products() : HasMany 
    {
        return $this->hasMany(
            related: Product::class,
            foreignKey: 'supplier_id',
        ); 
    }
}
