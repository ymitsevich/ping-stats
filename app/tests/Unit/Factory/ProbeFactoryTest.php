<?php

namespace App\Tests\Unit\Factory;

use App\Dto\PingResponse;
use App\Entity\Probe;
use App\Factory\ProbeFactory;
use PHPUnit\Framework\TestCase;

class ProbeFactoryTest extends TestCase
{
    public function testCreateByPingResponseWithSuccessfulPingResponse(): void
    {
        $pingResponse = new PingResponse(true, 100, 'Response content');

        $probe = (new ProbeFactory())->createByPingResponse($pingResponse);

        $this->assertInstanceOf(Probe::class, $probe);
        $this->assertTrue($probe->isSuccess());
        $this->assertSame('Response content', $probe->getResponse());
        $this->assertSame(100, $probe->getPing());
    }

    public function testCreateByPingResponseWithFailedPingResponse(): void
    {
        $pingResponse = new PingResponse(false, null, 'Failed response content');

        $probe = (new ProbeFactory())->createByPingResponse($pingResponse);

        $this->assertInstanceOf(Probe::class, $probe);
        $this->assertFalse($probe->isSuccess());
        $this->assertSame('Failed response content', $probe->getResponse());
        $this->assertNull($probe->getPing());
    }
}
