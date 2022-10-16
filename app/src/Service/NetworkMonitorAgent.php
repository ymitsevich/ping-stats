<?php

namespace App\Service;

use App\Factory\ProbeFactory;
use App\Repository\ProbeRepositoryInterface;

class NetworkMonitorAgent
{
    public function __construct(
        private readonly ProbeFactory $probeFactory,
        private readonly ProbeRepositoryInterface $probeRepository,
        private readonly LooperInterface $looper,
        private readonly PingerInterface $pinger,
    ) {
    }

    public function run(): void
    {
        $this->looper->run(function (): void {
            $pingResponse = $this->pinger->ping();
            $probe = $this->probeFactory->createByPingResponse($pingResponse);
            $this->probeRepository->store($probe);
        });
    }
}
