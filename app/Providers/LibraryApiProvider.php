<?php

namespace App\Providers;

use App\OpenLibraryApi;
use Illuminate\Support\ServiceProvider;

class LibraryApiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('\App\OpenLibraryApi', function ($app) {
            return new \App\OpenLibraryApi();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
