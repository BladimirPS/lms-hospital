<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\DocStudio\DiplomaDataSource;
use TommasoMusetti\DocStudio\DocumentRenderer;

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
        app(DocumentRenderer::class)->registerDataSource(DiplomaDataSource::class);
    }
}
