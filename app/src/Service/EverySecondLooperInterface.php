<?php

namespace App\Service;

use DateTimeImmutable;

class EverySecondLooperInterface implements LooperInterface
{
    public function run(callable $callback): void
    {
        while (true) {
            $before = new DateTimeImmutable();

            $callback();

            $after = new DateTimeImmutable();
            $diffSeconds = $after->diff($before)->format('%s');
            if ($diffSeconds < 1) {
                sleep(1);
            }
        }
    }
}
