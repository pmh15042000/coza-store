<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    public function boot(Charts $charts)
    {
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        Paginator::useBootstrap();
        $charts->register([
            \App\Charts\SalesChart::class
        ]);
    }
}
