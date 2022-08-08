<?php

namespace Eliasmpjunior\Caravela\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

use Eliasmpjunior\Caravela\Console\Commands\CaravelaInfoCommand;
use Eliasmpjunior\Caravela\Console\Commands\CaravelaServicesCommand;


class EmpjCaravelaServiceProvider extends ServiceProvider
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
                CaravelaInfoCommand::class,
                CaravelaServicesCommand::class,
            ]);
        }

        /**
         * Set up publish
         */
        $this->publishes([
            str_replace('/src/Eliasmpjunior/Caravela/Providers', '/config/config.php', __DIR__) => config_path('empj-caravela.php'),
        ]);

        /**
         * Set up migrations
         */
        $this->loadMigrationsFrom(str_replace('/src/Eliasmpjunior/Caravela/Providers', '/database/migrations', __DIR__));

        /**
         * Set up connection
         */
        $caravelaConnection = config('database.connections.'.(is_null(config('empj-caravela.connection')) ? config('database.default') : config('empj-caravela.connection')));

        Config::set('database.connections.caravela', $caravelaConnection);
    }
}
