<?php

namespace App\Service;

use App\Contract\FooRepositoryInterface;

class FooService
{
    private $repo;

    public function __construct(FooRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}