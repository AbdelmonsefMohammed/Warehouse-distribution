<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
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
}
