<?php

declare(strict_types=1);

namespace App\Services;

use Meilisearch\Client;
use Illuminate\Contracts\Foundation\Application;


final readonly class SearchService
{
    public function __construct(
        private Client $client,
    ) 
    {}

    public function search(string|null $term = null, int $limit, int $offset) : array
    {
        return $this->client->index('product_index')->search(
            query: $term,
            searchParams: [
                'limit' => $limit,
                'offset' => $offset,
            ]
        )->getHits(); 
    }

    public static function register(Application $app) : void 
    {
        $app->bind(
            abstract: SearchService::class,
            concrete: fn () => new SearchService(
                client: new Client(
                    url: config('scout.meilisearch.host'),
                    apiKey: config('scout.meilisearch.key')

                ),
            ),
        );
    }
}
