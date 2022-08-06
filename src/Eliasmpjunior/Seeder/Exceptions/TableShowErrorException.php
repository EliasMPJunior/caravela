<?php

namespace Eliasmpjunior\Seeder\Exceptions;

use Eliasmpjunior\Brasitable\Contracts\BrasitableException;


class TableShowErrorException extends SeederException
{
    protected $brasitableException = null;

    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct(BrasitableException $brasitableException)
    {
        $this->brasitableException = $brasitableException;
    }

    public function printException()
    {
        $this->brasitableException->printException();
    }
}