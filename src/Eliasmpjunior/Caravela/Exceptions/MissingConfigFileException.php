<?php

namespace Eliasmpjunior\Caravela\Exceptions;


class MissingConfigFileException extends CaravelaException
{
    public function printException()
    {
        $this->printMessage('The config file empj-caravela is missing.');
    }
}