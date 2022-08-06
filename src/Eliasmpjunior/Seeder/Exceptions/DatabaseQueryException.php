<?php

namespace Eliasmpjunior\Seeder\Exceptions;

use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

use Eliasmpjunior\Brasitable\Contracts\BrasitableException;


class DatabaseQueryException extends SeederException
{
    protected $queryException = null;

    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct(QueryException $queryException)
    {
        $this->queryException = $queryException;
    }

    public function printException()
    {
        if (
                Str::contains($this->queryException->getMessage(), 'Undefined table')
                and Str::contains($this->queryException->getMessage(), 'relation "')
                and Str::contains($this->queryException->getMessage(), '" does not exist')
            )
        {
            $this->printMessage('The table "'.Str::afterLast(Str::beforeLast($this->queryException,'"'),'"').'" has not been found. Migrate your database before using Seeder.');
        }
        else
        {
            $this->printMessage($this->queryException->getMessage());
        }
    }
}