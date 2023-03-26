<?php

namespace App\Tests\Repository;

use App\Entity\Probe;
use App\Repository\SqlProbeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class SqlProbeRepositoryTest extends TestCase
{
    public function testStore(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $repository = $this->createMock(ObjectRepository::class);

        $probe = new Probe();

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($probe);

        $entityManager->expects($this->once())
            ->method('flush');

        $sqlProbeRepository = new SqlProbeRepository($repository, $entityManager);

        $sqlProbeRepository->store($probe);
    }
}
