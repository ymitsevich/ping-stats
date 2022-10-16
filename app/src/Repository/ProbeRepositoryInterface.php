<?php

namespace App\Repository;

use App\Entity\Probe;

interface ProbeRepositoryInterface
{
    public function store(Probe $probe): void;
}
