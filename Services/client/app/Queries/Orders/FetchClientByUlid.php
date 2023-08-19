<?php

declare( strict_types = 1);

namespace App\Queries\Orders;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

final class FetchClientByUlid
{
    public function handle(string $ulid) : Model|Client|null 
    {
        return Client::query()->findOrFail(
            id: $ulid,
        );
    }
}