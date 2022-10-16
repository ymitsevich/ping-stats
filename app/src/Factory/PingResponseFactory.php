<?php

namespace App\Factory;

use App\Dto\PingResponse;

class PingResponseFactory
{
    public function create(bool $isSuccessful, ?int $ping, string $content): PingResponse
    {
        return new PingResponse($isSuccessful, $ping, $content);
    }
}
