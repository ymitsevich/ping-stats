<?php

namespace App\Tests\Service;

use App\Dto\PingResponse;
use App\Exception\ShellCommandException;
use App\Factory\PingResponseFactory;
use App\Service\AwsShellPinger;
use App\Service\CommandExecutorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AwsShellPingerTest extends TestCase
{
    private readonly MockObject|CommandExecutorInterface $commandExecutor;
    private readonly MockObject|PingResponseFactory $pingResponseFactory;
    private readonly AwsShellPinger $pinger;

    public function setUp(): void
    {
        $this->commandExecutor = $this->createMock(CommandExecutorInterface::class);
        $this->pingResponseFactory = $this->createMock(PingResponseFactory::class);
        $this->pinger = new AwsShellPinger($this->commandExecutor, $this->pingResponseFactory);
    }

    public function testPingSuccess()
    {
        $this->commandExecutor->expects($this->once())
            ->method('execute')
            ->with('ping -c 1 1.1.1.1')
            ->willReturn([
                'PING 1.1.1.1 (1.1.1.1): 56 data bytes',
                '64 bytes from 1.1.1.1: icmp_seq=0 ttl=59 time=39.718 ms',
                '',
                '--- 1.1.1.1 ping statistics ---',
                '1 packets transmitted, 1 packets received, 0.0% packet loss',
                'round-trip min/avg/max/stddev = 39.718/39.718/39.718/0.000 ms',
            ]);

        $referencingObject = new PingResponse(true, 39, '');
        $this->pingResponseFactory->expects($this->once())
            ->method('create')
            ->with(
                true,
                39,
                'PING 1.1.1.1 (1.1.1.1): 56 data bytes
64 bytes from 1.1.1.1: icmp_seq=0 ttl=59 time=39.718 ms

--- 1.1.1.1 ping statistics ---
1 packets transmitted, 1 packets received, 0.0% packet loss
round-trip min/avg/max/stddev = 39.718/39.718/39.718/0.000 ms'
            )
            ->willReturn($referencingObject);

        $pingResponse = $this->pinger->ping();

        $this->assertInstanceOf(PingResponse::class, $pingResponse);
        $this->assertEquals($referencingObject, $pingResponse);
    }

    public function testPingFailure()
    {
        $this->commandExecutor->expects($this->once())
            ->method('execute')
            ->with('ping -c 1 1.1.1.1')
            ->willThrowException(new ShellCommandException(1));

        $referencingObject = new PingResponse(false, null, '');
        $this->pingResponseFactory->expects($this->once())
            ->method('create')
            ->with(false, null, '')
            ->willReturn($referencingObject);

        $pingResponse = $this->pinger->ping();

        $this->assertInstanceOf(PingResponse::class, $pingResponse);
        $this->assertEquals($referencingObject, $pingResponse);
    }
}
