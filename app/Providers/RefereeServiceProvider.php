<?php

namespace Energy\Providers;

use Illuminate\Support\ServiceProvider;
use Energy\Services\RefereeService;

class RefereeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Energy\Contracts\RefereeContract', function ($app) {
            return new RefereeService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Energy\Contracts\RefereeContract'];
    }
}
