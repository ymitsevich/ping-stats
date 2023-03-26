<?php

namespace App\Tests\Unit\Factory;

use App\Factory\PingResponseFactory;
use PHPUnit\Framework\TestCase;
use App\Dto\PingResponse;

class PingResponseFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $factory = new PingResponseFactory();
        $isSuccessful = true;
        $ping = 100;
        $content = 'Example content';

        $response = $factory->create($isSuccessful, $ping, $content);

        $this->assertInstanceOf(PingResponse::class, $response);
        $this->assertSame($isSuccessful, $response->isSuccessful());
        $this->assertSame($ping, $response->getPing());
        $this->assertSame($content, $response->getContent());
    }
}
