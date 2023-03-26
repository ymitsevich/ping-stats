<?php

namespace App\Service;

use App\Exception\ShellCommandException;

interface CommandExecutorInterface
{
    /**
     * @throws ShellCommandException
     */
    public function execute(string $command): array;
}
