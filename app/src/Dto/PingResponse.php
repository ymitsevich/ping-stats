<?php

namespace App\Dto;

class PingResponse
{
    public function __construct(private readonly bool $isSuccessful, private readonly string $content)
    {
    }

    public function isSuccessful(): bool
    {
        return $this->isSuccessful;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
