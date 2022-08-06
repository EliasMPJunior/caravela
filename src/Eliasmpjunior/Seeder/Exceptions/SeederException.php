<?php

namespace Eliasmpjunior\Seeder\Exceptions;

use Web64\Colors\Facades\Colors;

use RuntimeException;


abstract class SeederException extends RuntimeException
{
    abstract public function printException();

    public function printMessage(string $mainMessage, string $extraMessage = null)
    {
        $errorTitle = ' ERROR ';
        $mainMessage = ' '.trim($mainMessage).' ';

        Colors::line('');

        $this->printEmptyErrorLine($errorTitle, $mainMessage);

        Colors::nobr()->error($errorTitle);
        Colors::deleted($mainMessage);

        $this->printEmptyErrorLine($errorTitle, $mainMessage);

        Colors::line('');
    }

    protected function printEmptyErrorLine(string $errorTitle, string $mainMessage)
    {
        for ($i = 0; $i < strlen($errorTitle); $i++)
        { 
            Colors::nobr()->error(' ');
        }

        for ($i = 0; $i < strlen($mainMessage); $i++)
        { 
            Colors::nobr()->deleted(' ');
        }

        Colors::line('');
    }
}