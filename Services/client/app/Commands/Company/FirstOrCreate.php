<?php

declare( strict_types = 1);

namespace App\Commands\Company;

use App\Models\Company;
use App\Http\Payloads\NewClient;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\Launchpad\Database\Portal;

final readonly class FirstOrCreate
{
    public function __construct(
        private Portal $database,
    ) {}

    public function handle(string $name, string $email) : Model|Company 
    {
        return $this->database->transaction(
            callback: fn () => Company::query()->create(
                attributes: ['name' => $name, 'email' => $email],
            )
        );
    }
}