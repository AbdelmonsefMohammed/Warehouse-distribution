<?php

declare( strict_types = 1 );

namespace App\Providers;

use App\Services\CatalogService;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        CatalogService::register(
            app: $this->app,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
