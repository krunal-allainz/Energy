<?php

namespace Energy\Providers;

use Illuminate\Support\ServiceProvider;
use Energy\Services\TeamService;
use Energy\Repositories\TeamRepository;

class TeamServiceProvider extends ServiceProvider
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
        $this->app->bind('Energy\Contracts\TeamContract', function ($app) {
            return new TeamService(new TeamRepository());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Energy\Contracts\TeamContract'];
    }
}
