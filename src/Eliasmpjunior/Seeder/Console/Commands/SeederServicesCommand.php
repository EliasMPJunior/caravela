<?php

namespace Eliasmpjunior\Seeder\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

use Eliasmpjunior\Seeder\Models\Service;
use Eliasmpjunior\Seeder\Exceptions\DatabaseQueryException;


class SeederServicesCommand extends Command
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
        try
        {
            $services = Service::all();
        }
        catch (QueryException $e)
        {
            (new DatabaseQueryException($e))->printException();

            return 1;
        }

        return 0;
    }
}
