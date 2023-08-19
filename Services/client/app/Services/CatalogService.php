<?php

declare( strict_types = 1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Contracts\Foundation\Application;

final class CatalogService
{
    public function __construct(
        private readonly PendingRequest $request,
    ) {}

    public function lookup(string $product) : array 
    {
        return Cache::remember(
            key: "lookup_$product",
            ttl: 3600,
            callback:  fn () => $this->request->get(
                url: "/products/$product",
            )->json(),
        );    
    }
    public static function register(Application $app) : void 
    {
        $app->bind(
            abstract: CatalogService::class,
            concrete: fn () => new CatalogService(
                request: Http::baseUrl(
                    url: 'http://127.0.0.1:8001',

                )->timeout(
                    seconds: 60,
                )->asJson()->acceptJson(),

            ),
        );
    }
}