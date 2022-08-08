<?php

namespace Eliasmpjunior\Caravela\Exceptions;


class TableShowErrorException extends CaravelaException
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
