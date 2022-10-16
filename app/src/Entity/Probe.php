<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Probe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $isSuccess = null;

    #[ORM\Column(length: 10000)]
    private ?string $response = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->setFail();
        $this->createdAt = new DateTimeImmutable();
    }

    public static function createSuccessful(): self
    {
        $entity = new self();
        $entity->setSuccess();
        $entity->createdAt = new DateTimeImmutable();

        return $entity;
    }

    public static function createFailed(): self
    {
        $entity = new self();
        $entity->setFail();
        $entity->createdAt = new DateTimeImmutable();

        return $entity;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSuccess(): ?bool
    {
        return $this->isSuccess;
    }

    public function setSuccess(): self
    {
        $this->isSuccess = true;

        return $this;
    }

    public function setFail(): self
    {
        $this->isSuccess = false;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(?string $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
