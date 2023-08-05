<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
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
