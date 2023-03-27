<?php

namespace App\Tests\Service;

use App\Dto\PingResponse;
use App\Entity\Probe;
use App\Factory\ProbeFactory;
use App\Repository\ProbeRepositoryInterface;
use App\Service\LooperInterface;
use App\Service\NetworkMonitorAgent;
use App\Service\PingerInterface;
use PHPUnit\Framework\TestCase;

class NetworkMonitorAgentTest extends TestCase
{
    private ProbeFactory $probeFactory;
    private ProbeRepositoryInterface $probeRepository;
    private LooperInterface $looper;
    private PingerInterface $pinger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->probeFactory = $this->createMock(ProbeFactory::class);
        $this->probeRepository = $this->createMock(ProbeRepositoryInterface::class);
        $this->looper = $this->createMock(LooperInterface::class);
        $this->pinger = $this->createMock(PingerInterface::class);
    }

    public function testRun()
    {
        $pingResponse = $this->createMock(PingResponse::class);
        $probe = $this->createMock(Probe::class);

        $this->pinger
            ->expects($this->once())
            ->method('ping')
            ->willReturn($pingResponse);

        $this->probeFactory
            ->expects($this->once())
            ->method('createByPingResponse')
            ->with($pingResponse)
            ->willReturn($probe);

        $this->probeRepository
            ->expects($this->once())
            ->method('store')
            ->with($probe);

        $this->looper
            ->expects($this->once())
            ->method('run')
            ->with(
                $this->callback(function ($arg1): bool {
                    $arg1();
                    return true;
                })
            );

        $agent = new NetworkMonitorAgent($this->probeFactory, $this->probeRepository, $this->looper, $this->pinger);
        $agent->run();
    }
}
