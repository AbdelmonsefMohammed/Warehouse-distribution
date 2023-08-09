<?php

declare( strict_types = 1);

namespace App\Commands\Clients;

use App\Http\Payloads\NewClient;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\Launchpad\Database\Portal;
use App\Models\Client;

final readonly class CreateNewClient
{
    public function __construct(
        private Portal $database,
    ) {}

    public function handle(NewClient $payload) : Model|Client 
    {
        return $this->database->transaction(
            callback: fn () => Client::query()->create(
                attributes: $payload->toArray(),
            )
        );
    }
}