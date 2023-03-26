<?php

namespace App\Service;
use App\Exception\ShellCommandException;

class ShellCommandExecutor implements CommandExecutorInterface
{
    public function execute(string $command): array
    {
        $output = [];
        $returnValue = null;
        exec($command, $output, $returnValue);
        if ($returnValue) {
            throw new ShellCommandException($returnValue);
        }
        return $output;
    }
}
