<?php

namespace App\Dto;

class PingResponse
{
    public function __construct(
        private readonly bool $isSuccessful,
        private readonly ?int $ping,
        private readonly string $content
    ) {
    }

    public function isSuccessful(): bool
    {
        return $this->isSuccessful;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getPing(): ?int
    {
        return $this->ping;
    }
}
