<?php

namespace App\Repository;

use App\Entity\Probe;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class SqlProbeRepository implements ProbeRepositoryInterface
{
    public function __construct(
        private readonly ObjectRepository $nativeRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function store(Probe $probe): void
    {
        $this->entityManager->persist($probe);
        $this->entityManager->flush();
    }
}
