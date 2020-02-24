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
        $this->app->bind('App\Contracts\LibraryApi', 'App\OpenLibraryApi');
        $this->app->singleton('App\Contracts\LibraryApi', function () {
            return new OpenLibraryApi();
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
