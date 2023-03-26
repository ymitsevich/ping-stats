<?php

namespace App\Exception;

use Exception;

class ShellCommandException extends Exception
{
    public function __construct(private readonly int $returnValue)
    {
    }
}
