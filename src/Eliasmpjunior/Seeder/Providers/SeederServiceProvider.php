<?php

namespace Eliasmpjunior\Seeder\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

use Eliasmpjunior\Seeder\Console\Commands\SeederInfoCommand;
use Eliasmpjunior\Seeder\Console\Commands\SeederServicesCommand;


class SeederServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    	//
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SeederInfoCommand::class,
                SeederServicesCommand::class,
            ]);
        }
    }
}
