<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $locale = request('lang', 'en');
        App::setLocale($locale);

        // App::currentLocale();

        Paginator::useBootstrapFive();
        // Paginator::defaultView('vendor.pagination.bootstrap-4');
        // Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-4');
    }
}
