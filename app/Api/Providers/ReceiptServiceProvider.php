<?php

namespace euro_hms\Api\Providers;

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
         $this->app->bind('euro_hms\Api\Contracts\ReceiptContract', function ($app) {
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
        return ['euro_hms\Api\Contracts\ReceiptContract'];
    }
}
