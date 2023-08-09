<?php

declare( strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $website
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class Company extends Model
{
    use HasFactory, HasUlids, Notifiable;

    protected $fillable = ['name', 'website', 'email'];

    public function clients() : HasMany 
    {
        return $this->hasMany(
            related: Client::class,
            foreignKey: 'company_id',
        ); 
    }

    public function members() : HasMany 
    {
        return $this->hasMany(
            related: Member::class,
            foreignKey: 'company_id',
        ); 
    }
}
