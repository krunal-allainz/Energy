<?php

namespace Energy\Providers;

use Illuminate\Support\ServiceProvider;
use Energy\Services\AgeGroupService;
use Energy\Repositories\AgeGroupRepository;

class AgeGroupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the Application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the Application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Energy\Contracts\AgeGroupContract', function ($app) {
            return new AgeGroupService(new AgeGroupRepository());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Energy\Contracts\AgeContract'];
    }
}
