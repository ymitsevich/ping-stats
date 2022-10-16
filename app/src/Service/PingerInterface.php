<?php

namespace App\Service;

use App\Dto\PingResponse;

interface PingerInterface
{
    public function ping(): PingResponse;
}
