<?php

namespace App\Factory;

use App\Dto\PingResponse;

class PingResponseFactory
{
    public function create(bool $isSuccessful, string $content): PingResponse
    {
        return new PingResponse($isSuccessful, $content);
    }
}
