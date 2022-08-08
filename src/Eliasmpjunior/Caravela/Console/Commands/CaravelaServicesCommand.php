<?php

namespace Eliasmpjunior\Caravela\Console\Commands;

use Illuminate\Console\Command;
use Web64\Colors\Facades\Colors;
use Illuminate\Database\QueryException;

use Eliasmpjunior\Caravela\Models\Service;
use Eliasmpjunior\Caravela\Exceptions\DatabaseQueryException;
use Eliasmpjunior\Caravela\Exceptions\MissingConfigFileException;


class CaravelaServicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeder:services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ( ! is_array(config('empj-caravela')))
        {
            (new MissingConfigFileException)->printException();

            if ($this->confirm('Do you wish to publish it now?'))
            {
                $this->call('vendor:publish', [
                    '--provider' => 'Eliasmpjunior\Caravela\Providers\CaravelaServiceProvider',
                ]);
            }
            else
            {
                Colors::light_yellow('Publish it running php artisan vendor:publish --provider="Eliasmpjunior\Caravela\Providers\CaravelaServiceProvider".');

                Colors::line('');

                return 1;
            }
        }

        try
        {
            $services = Service::all();
        }
        catch (QueryException $e)
        {
            (new DatabaseQueryException($e))->printException();

            return 2;
        }

        return 0;
    }
}
