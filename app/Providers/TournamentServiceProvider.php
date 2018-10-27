<?php

namespace Energy\Providers;

use Illuminate\Support\ServiceProvider;
use Energy\Services\TournamentService;
use Energy\Services\VenueTempService as VenueService;
use Energy\Repositories\VenueRepository;
use Energy\Repositories\TournamentRepository;

class TournamentServiceProvider extends ServiceProvider
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
        $this->app->bind('Energy\Contracts\TournamentContract', function ($app) {
            return new TournamentService(new TournamentRepository(), new VenueService(new VenueRepository()));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Energy\Contracts\TournamentContract'];
    }
}
