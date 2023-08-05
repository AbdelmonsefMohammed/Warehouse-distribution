<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['role','client_id','company_id'];

    protected $casts = ['role' => Role::class,];

    public function client() : BelongsTo 
    {
        return $this->belongsTo(
            related: Client::class,
            foreignKey: 'client_id',
        );
    }

    public function company() : BelongsTo 
    {
        return $this->belongsTo(
            related: Company::class,
            foreignKey: 'company_id',
        );
    }
}
