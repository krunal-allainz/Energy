<?php

namespace Energy\Api\Providers;

use Illuminate\Support\ServiceProvider;

class ReceiptServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
         $this->app->bind('Energy\Api\Contracts\ReceiptContract', function ($app) {
            return new ReceiptService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Energy\Api\Contracts\ReceiptContract'];
    }
}
