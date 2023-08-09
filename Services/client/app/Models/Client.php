<?php

declare( strict_types = 1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class Client extends Model
{
    use HasFactory, HasUlids, Notifiable;

    protected $fillable = ['name', 'email','company_id'];

    public function company() : BelongsTo 
    {
        return $this->belongsTo(
            related: Company::class,
            foreignKey: 'company_id',
        );
    }

    public function membership() : HasOne 
    {
        return $this->hasOne(
            related: Member::class,
            foreignKey: 'client_id',
        );    
    }

    public function orders() : HasMany 
    {
        return $this->hasMany(
            related: Order::class,
            foreignKey: 'client_id',
        ); 
    }
}
