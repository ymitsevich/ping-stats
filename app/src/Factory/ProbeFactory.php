<?php

namespace App\Factory;

use App\Dto\PingResponse;
use App\Entity\Probe;

class ProbeFactory
{
    public function createByPingResponse(PingResponse $pingResponse): Probe
    {
        $probe = $pingResponse->isSuccessful() ? Probe::createSuccessful() : Probe::createFailed();
        $probe->setResponse($pingResponse->getContent());

        return $probe;
    }
}
