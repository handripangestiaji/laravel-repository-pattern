<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Contract\FooRepositoryInterface;
use App\Repository\FooRepository;
use App\User;

class FooRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRepositoryClassImplementToItsInterface()
    {
        $user = new User();
        $repo = new FooRepository($user);

        $this->assertInstanceOf(FooRepositoryInterface::class, $repo);
    }
}
