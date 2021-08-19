<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\Interfaces\\DomDocumentInterface", "App\Repositories\\HtmlRepository");
        $this->app->bind("App\Interfaces\\ProductInterface", "App\Repositories\\ProductRepository");
    }
}
