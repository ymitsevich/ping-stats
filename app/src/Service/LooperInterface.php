<?php

namespace App\Service;

interface LooperInterface
{
    public function run(callable $callback): void;
}
